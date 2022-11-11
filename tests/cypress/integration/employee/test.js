/// <reference types="cypress" />

import {Pagination} from "../../support/page-object/pagination";
import {SubmitForm} from "../../support/page-object/submit-form";

context('Employee for test', () => {
    let employeeCredentials;
    let createTestData;
    let editTestData;
    let cloneTestData;

    before(() => {
        cy.refreshDatabase()
            .seed('DatabaseSeeder');

        cy.fixture('credentials').then(function (data) {
            employeeCredentials = data.employee;
        });

        cy.fixture('test').then(function (data) {
            createTestData = data.create;
            editTestData = data.edit;
            cloneTestData = data.clone;
        });

    });

    beforeEach(() => {
        cy.login({email: employeeCredentials.email});
        cy.visit({route: 'employee.tests.index'});
    });

    it('Pagination', () => {
        // Check Default 10 page row
        new Pagination('App\\Models\\Test', 10, 3);
    });

    it('Pagination change', () => {
        // Check 15 page row
        cy.get("[data-cy=per-page]:eq(0)").should("be.visible").select('15').wait(500)
        new Pagination('App\\Models\\Test', 15, 3);
    });

    it.only('Create', () => {
        cy.get("[data-cy=table-action]:eq(0)").should("be.visible").contains('Create').click();

        let totalCount;
        cy.php('App\\Models\\Test::count();').then(testCount => {
            totalCount = testCount;
        });

        const testsForm = new SubmitForm('#testForm');
        testsForm.enterText('[name=name]', createTestData.name, ['required']);
        testsForm.enterText('[name=description]', createTestData.description, ['required']);
        testsForm.selectDropdown('[name=duration]', createTestData.duration, ['required']);
        testsForm.customeMultiCheckbox('[name=courses]', createTestData.courses);
        testsForm.selectDropdown('[name=is_active]', createTestData.is_active, ['required']);
        testsForm.selectDropdown('[name=is_required]', createTestData.is_required, ['required']);
        testsForm.enterText('[name=link]', createTestData.link, ['required']);
        testsForm.submit();

        cy.php('App\\Models\\Test::count();').then(test => {
            expect(test).to.equal(totalCount + 1);
        });
    });

    it('Search index', () => {
        // Wrong Value check
        cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type('Wrong Value Enter For Test').wait(500);
        cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');

        cy.php('App\\Models\\Test::latest()->get()->first();').then(test => {
            // Right Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(test.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', test.name);

            // Right half Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(test.name.slice(0, -1)).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', test.name);

            // Right And Wrong Value Check With Column
            let columnArray = ['name', 'description', 'duration', 'link'];
            columnArray.forEach(column => {
                // Wrong Value Enter
                cy.get("[data-cy=datatable-column]:eq(0)").should("be.visible").select(column);
                cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type('Wrong Value Enter For Test').wait(500);
                cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');

                // Right Value Enter
                cy.get("[data-cy=datatable-column]:eq(0)").should("be.visible").select(column);
                cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(test[column]).wait(500);
                cy.get('#dataTable tbody').find('tr').should('have.length', 1);
            });
        });

        cy.wait(500);
    });

    it('Edit without change', () => {
        cy.php('App\\Models\\Test::latest()->get()->first();').then(test => {
            let totalCount;
            cy.php('App\\Models\\Test::count();').then(testCount => {
                totalCount = testCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(test.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', test.name);
            cy.get("[data-cy=edit-button-" + test.id + "]:eq(0)").click();

            cy.wait(500);
            const testsForm = new SubmitForm('#testForm');
            let columnArray = [
                ['name', 'input'], ['description', 'input'], ['duration', 'select'],
                ['is_required', 'select'], ['is_active', 'select'], ['link', 'input']];
            columnArray.forEach(column => {
                testsForm.matchValue('[name=' + column[0] + ']', test[column[0]].toString(), column[1]);
            });
            testsForm.submit();

            cy.php('App\\Models\\Test::count();').then(test => {
                expect(test).to.equal(totalCount);
            });
        });
    });

    it('Edit with change', () => {
        cy.php('App\\Models\\Test::latest()->get()->first();').then(test => {
            let totalCount;
            cy.php('App\\Models\\Test::count();').then(testCount => {
                totalCount = testCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(test.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', test.name);
            cy.get("[data-cy=edit-button-" + test.id + "]:eq(0)").click().wait(500);

            const testsForm = new SubmitForm('#testForm');
            testsForm.enterText('[name=name]', editTestData.name);
            testsForm.enterText('[name=description]', editTestData.description);
            testsForm.selectDropdown('[name=duration]', editTestData.duration);
            testsForm.selectDropdown('[name=is_active]', editTestData.is_active);
            testsForm.selectDropdown('[name=is_required]', editTestData.is_required);
            testsForm.enterText('[name=link]', editTestData.link);
            testsForm.customeMultiCheckbox('[name=courses]', editTestData.courses);
            testsForm.submit();

            cy.php('App\\Models\\Test::find(' + test.id + ');').then(test => {
                // TODO: courses assert check left
                let columnArray = ['name', 'description', 'duration', 'is_required', 'is_active', 'link'];
                columnArray.forEach(column => {
                    expect(test[column].toString()).to.equal(editTestData[column]);
                });
            });

            cy.php('App\\Models\\Test::count();').then(test => {
                expect(test).to.equal(totalCount);
            });
        });
    });

    it('Delete', () => {
        cy.php('App\\Models\\Test::latest()->get()->first();').then(test => {
            let totalCount;
            cy.php('App\\Models\\Test::count();').then(testCount => {
                totalCount = testCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(test.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', test.name);
            cy.get("[data-cy=delete-button-" + test.id + "]:eq(0)").click();

            // Cancel Button Work
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=cancel-button]:eq(0)").click()

            cy.php('App\\Models\\Test::count();').then(test => {
                expect(test).to.equal(totalCount);
            });

            // Delete Button
            cy.get("[data-cy=delete-button-" + test.id + "]:eq(0)").click();
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=delete-button]:eq(0)").click().wait(500)
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');
            cy.php('App\\Models\\Test::count();').then(test => {
                expect(test).to.equal(totalCount - 1);
            });
        });
    });
});
