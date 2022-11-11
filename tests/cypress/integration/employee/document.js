/// <reference types="cypress" />

import {Pagination} from "../../support/page-object/pagination";
import {SubmitForm} from "../../support/page-object/submit-form";

context('Employee for document', () => {
    let employeeCredentials;
    let createDocumentData;
    let editDocumentData;
    let cloneDocumentData;

    before(() => {
        cy.refreshDatabase()
            .seed('DatabaseSeeder');

        cy.fixture('credentials').then(function (data) {
            employeeCredentials = data.employee;
        });

        cy.fixture('document').then(function (data) {
            createDocumentData = data.create;
            editDocumentData = data.edit;
            cloneDocumentData = data.clone;
        });

    });

    beforeEach(() => {
        cy.login({email: employeeCredentials.email});
        cy.visit({route: 'employee.documents.index'});
    });

    it('Pagination', () => {
        // Check Default 10 page row
        new Pagination('App\\Models\\Document', 10, 2);
    });

    it('Pagination change', () => {
        // Check 15 page row
        cy.get("[data-cy=per-page]:eq(0)").should("be.visible").select('15').wait(500)
        new Pagination('App\\Models\\Document', 15, 2);
    });

    it('Create', () => {
        cy.get("[data-cy=table-action]:eq(0)").should("be.visible").contains('Create').click();

        let totalCount;
        cy.php('App\\Models\\Document::count();').then(documentCount => {
            totalCount = documentCount;
        });

        const documentsForm = new SubmitForm('#documentForm');
        documentsForm.enterText('[name=name]', createDocumentData.name, ['required']);
        documentsForm.enterText('[name=placeholder]', createDocumentData.placeholder, ['required']);
        documentsForm.enterText('[name=extensions]', createDocumentData.extensions, ['required']);
        documentsForm.selectDropdown('[name=is_required]', createDocumentData.is_required, ['required']);
        documentsForm.selectDropdown('[name=is_active]', createDocumentData.is_active, ['required']);
        documentsForm.customeMultiCheckbox('[name=courses]', createDocumentData.courses);
        documentsForm.submit();

        cy.php('App\\Models\\Document::count();').then(document => {
            expect(document).to.equal(totalCount + 1);
        });
    });

    it('Create duplicate entry ', () => {
        cy.php('App\\Models\\Document::latest()->get()->first();').then(document => {
            let totalCount;
            cy.php('App\\Models\\Document::count();').then(documentCount => {
                totalCount = documentCount;
            });

            cy.get("[data-cy=table-action]:eq(0)").should("be.visible").contains('Create').click();

            const documentsForm = new SubmitForm('#documentForm');
            documentsForm.enterText('[name=name]', document.name, ['exist']);
            documentsForm.submit();

            cy.php('App\\Models\\Document::count();').then(document => {
                expect(document).to.equal(totalCount);
            });
        });
    });

    it('Search index', () => {
        // Wrong Value check
        cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type('Wrong Value Enter For Test').wait(500);
        cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');

        cy.php('App\\Models\\Document::latest()->get()->first();').then(document => {
            // Right Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(document.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', document.name);

            // Right half Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(document.name.slice(0, -1)).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', document.name);

            // Right And Wrong Value Check With Column
            let columnArray = ['name', 'placeholder', 'extensions'];
            columnArray.forEach(column => {
                // Wrong Value Enter
                cy.get("[data-cy=datatable-column]:eq(0)").should("be.visible").select(column);
                cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type('Wrong Value Enter For Test').wait(500);
                cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');

                // Right Value Enter
                cy.get("[data-cy=datatable-column]:eq(0)").should("be.visible").select(column);
                cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(document[column]).wait(500);
                cy.get('#dataTable tbody').find('tr').should('have.length', 1);
            });
        });

        cy.wait(500);
    });

    it('Clone without change', () => {
        cy.php('App\\Models\\Document::latest()->get()->first();').then(document => {

            let totalCount;
            cy.php('App\\Models\\Document::count();').then(documentCount => {
                totalCount = documentCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(document.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', document.name);
            cy.get("[data-cy=clone-button-" + document.id + "]:eq(0)").click().wait(500);

            const documentsForm = new SubmitForm('#documentForm');
            documentsForm.enterText('[name=name]', document.name, ['exist']);
            documentsForm.submit();

            cy.php('App\\Models\\Document::count();').then(document => {
                expect(document).to.equal(totalCount);
            });
        });
    });

    it('Clone with change', () => {
        cy.php('App\\Models\\Document::latest()->get()->first();').then(document => {

            let totalCount;
            cy.php('App\\Models\\Document::count();').then(documentCount => {
                totalCount = documentCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(document.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', document.name);
            cy.get("[data-cy=clone-button-" + document.id + "]:eq(0)").click().wait(500);

            const documentsForm = new SubmitForm('#documentForm');
            documentsForm.enterText('[name=name]', cloneDocumentData.name);
            documentsForm.submit();

            cy.php('App\\Models\\Document::latest()->get()->first();').then(document => {
                let columnArray = ['name'];
                columnArray.forEach(column => {
                    expect(document[column]).to.equal(cloneDocumentData[column]);
                });
            });

            cy.php('App\\Models\\Document::count();').then(document => {
                expect(document).to.equal(totalCount + 1);
            });
        });
    });

    it('Edit without change', () => {
        cy.php('App\\Models\\Document::latest()->get()->first();').then(document => {
            let totalCount;
            cy.php('App\\Models\\Document::count();').then(documentCount => {
                totalCount = documentCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(document.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', document.name);
            cy.get("[data-cy=edit-button-" + document.id + "]:eq(0)").click();

            cy.wait(500);
            const documentsForm = new SubmitForm('#documentForm');
            let columnArray = [['name', 'input'], ['placeholder', 'input'], ['extensions', 'input'], ['is_required', 'select'], ['is_active', 'select']];
            columnArray.forEach(column => {
                documentsForm.matchValue('[name=' + column[0] + ']', document[column[0]].toString(), column[1]);
            });
            documentsForm.submit();

            cy.php('App\\Models\\Document::count();').then(document => {
                expect(document).to.equal(totalCount);
            });
        });
    });

    it('Edit with change', () => {
        cy.php('App\\Models\\Document::latest()->get()->first();').then(document => {
            let totalCount;
            cy.php('App\\Models\\Document::count();').then(documentCount => {
                totalCount = documentCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(document.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', document.name);
            cy.get("[data-cy=edit-button-" + document.id + "]:eq(0)").click().wait(500);

            const documentsForm = new SubmitForm('#documentForm');
            documentsForm.enterText('[name=name]', editDocumentData.name);
            documentsForm.enterText('[name=placeholder]', editDocumentData.placeholder);
            documentsForm.enterText('[name=extensions]', editDocumentData.extensions);
            documentsForm.selectDropdown('[name=is_required]', editDocumentData.is_required);
            documentsForm.selectDropdown('[name=is_active]', editDocumentData.is_active);
            documentsForm.customeMultiCheckbox('[name=courses]', editDocumentData.courses);
            documentsForm.submit();

            cy.php('App\\Models\\Document::find(' + document.id + ');').then(document => {
                // TODO: courses assert check left
                let columnArray = ['name', 'placeholder', 'extensions', 'is_required', 'is_active'];
                columnArray.forEach(column => {
                    expect(document[column].toString()).to.equal(editDocumentData[column]);
                });
            });

            cy.php('App\\Models\\Document::count();').then(document => {
                expect(document).to.equal(totalCount);
            });
        });
    });

    it('Delete', () => {
        cy.php('App\\Models\\Document::latest()->get()->first();').then(document => {
            let totalCount;
            cy.php('App\\Models\\Document::count();').then(documentCount => {
                totalCount = documentCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(document.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', document.name);
            cy.get("[data-cy=delete-button-" + document.id + "]:eq(0)").click();

            // Cancel Button Work
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=cancel-button]:eq(0)").click()

            cy.php('App\\Models\\Document::count();').then(document => {
                expect(document).to.equal(totalCount);
            });

            // Delete Button
            cy.get("[data-cy=delete-button-" + document.id + "]:eq(0)").click();
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=delete-button]:eq(0)").click().wait(500)
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');
            cy.php('App\\Models\\Document::count();').then(document => {
                expect(document).to.equal(totalCount - 1);
            });
        });
    });
});
