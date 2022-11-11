/// <reference types="cypress" />

import {Pagination} from "../../support/page-object/pagination";
import {SubmitForm} from "../../support/page-object/submit-form";

context('Employee for faq', () => {
    let employeeCredentials;
    let createFaqData;
    let editFaqData;
    let cloneFaqData;

    before(() => {
        cy.refreshDatabase()
            .seed('DatabaseSeeder');

        cy.fixture('credentials').then(function (data) {
            employeeCredentials = data.employee;
        });

        cy.fixture('faq').then(function (data) {
            createFaqData = data.create;
            editFaqData = data.edit;
            cloneFaqData = data.clone;
        });

    });

    beforeEach(() => {
        cy.login({email: employeeCredentials.email});
        cy.visit({route: 'employee.faq.index'});
    });

    it('Pagination', () => {
        // Check Default 10 page row
        new Pagination('App\\Models\\Faq', 10, 2);
    });

    it('Pagination change', () => {
        // Check 15 page row
        cy.get("[data-cy=per-page]:eq(0)").should("be.visible").select('15').wait(500)
        new Pagination('App\\Models\\Faq', 15, 2);
    });

    it('Create', () => {
        cy.get("[data-cy=table-action]:eq(0)").should("be.visible").contains('Create').click();

        let totalCount;
        cy.php('App\\Models\\Faq::count();').then(faqCount => {
            totalCount = faqCount;
        });

        const faqsForm = new SubmitForm('#faqForm');
        faqsForm.enterText('[name=name]', createFaqData.name, ['required']);
        faqsForm.enterText('[name=question]', createFaqData.question, ['required']);
        faqsForm.enterText('[name=answer]', createFaqData.answer, ['required']);
        faqsForm.customeMultiCheckbox('[name=courses]', createFaqData.courses);

        faqsForm.submit();

        cy.php('App\\Models\\Faq::count();').then(faq => {
            expect(faq).to.equal(totalCount + 1);
        });
    });

    it('Search index', () => {
        // TODO: sort functionality lest test
        // TODO: Create edit then sort wise add update check left
        // TODO: sort wise display in index page check left


        // Wrong Value check
        cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type('Wrong Value Enter For Test').wait(500);
        cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');

        cy.php('App\\Models\\Faq::latest()->get()->first();').then(faq => {
            // Right Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(faq.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', faq.name);

            // Right half Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(faq.name.slice(0, -1)).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', faq.name);

        });

        cy.wait(500);
    });

    it('Edit without change', () => {
        cy.php('App\\Models\\Faq::latest()->get()->first();').then(faq => {
            let totalCount;
            cy.php('App\\Models\\Faq::count();').then(faqCount => {
                totalCount = faqCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(faq.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', faq.name);
            cy.get("[data-cy=edit-button-" + faq.id + "]:eq(0)").click();

            cy.wait(500);
            const faqsForm = new SubmitForm('#faqForm');
            let columnArray = [['name', 'input'], ['question', 'input'], ['answer', 'input']];
            columnArray.forEach(column => {
                faqsForm.matchValue('[name=' + column[0] + ']', faq[column[0]].toString(), column[1]);
            });
            faqsForm.submit();

            cy.php('App\\Models\\Faq::count();').then(faq => {
                expect(faq).to.equal(totalCount);
            });
        });
    });

    it('Edit with change', () => {
        cy.php('App\\Models\\Faq::latest()->get()->first();').then(faq => {
            let totalCount;
            cy.php('App\\Models\\Faq::count();').then(faqCount => {
                totalCount = faqCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(faq.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', faq.name);
            cy.get("[data-cy=edit-button-" + faq.id + "]:eq(0)").click().wait(500);

            const faqsForm = new SubmitForm('#faqForm');
            faqsForm.enterText('[name=name]', editFaqData.name);
            faqsForm.enterText('[name=question]', editFaqData.question);
            faqsForm.enterText('[name=answer]', editFaqData.answer);
            faqsForm.customeMultiCheckbox('[name=courses]', editFaqData.courses);
            faqsForm.submit();

            cy.php('App\\Models\\Faq::find(' + faq.id + ');').then(faq => {
                // TODO: courses assert check left
                let columnArray = ['name', 'question', 'answer'];
                columnArray.forEach(column => {
                    expect(faq[column].toString()).to.equal(editFaqData[column]);
                });
            });

            cy.php('App\\Models\\Faq::count();').then(faq => {
                expect(faq).to.equal(totalCount);
            });
        });
    });

    it('Delete', () => {
        cy.php('App\\Models\\Faq::latest()->get()->first();').then(faq => {
            let totalCount;
            cy.php('App\\Models\\Faq::count();').then(faqCount => {
                totalCount = faqCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(faq.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', faq.name);
            cy.get("[data-cy=delete-button-" + faq.id + "]:eq(0)").click();

            // Cancel Button Work
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=cancel-button]:eq(0)").click()

            cy.php('App\\Models\\Faq::count();').then(faq => {
                expect(faq).to.equal(totalCount);
            });

            // Delete Button
            cy.get("[data-cy=delete-button-" + faq.id + "]:eq(0)").click();
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=delete-button]:eq(0)").click().wait(500)
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');
            cy.php('App\\Models\\Faq::count();').then(faq => {
                expect(faq).to.equal(totalCount - 1);
            });
        });
    });
});
