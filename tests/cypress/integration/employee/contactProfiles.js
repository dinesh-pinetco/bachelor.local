/// <reference types="cypress" />

import {Pagination} from "../../support/page-object/pagination";
import {SubmitForm} from "../../support/page-object/submit-form";

context('Employee for contact profile', () => {
    let employeeCredentials;
    let createContactProfileData;
    let editContactProfileData;
    let cloneContactProfileData;

    before(() => {
        cy.refreshDatabase()
            .seed('DatabaseSeeder');

        cy.fixture('credentials').then(function (data) {
            employeeCredentials = data.employee;
        });

        cy.fixture('contactProfile').then(function (data) {
            createContactProfileData = data.create;
            editContactProfileData = data.edit;
            cloneContactProfileData = data.clone;
        });

    });

    beforeEach(() => {
        cy.login({email: employeeCredentials.email});
        cy.visit({route: 'employee.contact-profiles.index'});
    });

    it('Pagination', () => {
        // Check Default 10 page row
        new Pagination('App\\Models\\ContactProfile', 10, 2);
    });

    it('Pagination change', () => {
        // Check 15 page row
        cy.get("[data-cy=per-page]:eq(0)").should("be.visible").select('15').wait(500)
        new Pagination('App\\Models\\ContactProfile', 15, 2);
    });

    it('Create', () => {
        cy.get("[data-cy=table-action]:eq(0)").should("be.visible").contains('Create').click();

        let totalCount;
        cy.php('App\\Models\\ContactProfile::count();').then(contactProfileCount => {
            totalCount = contactProfileCount;
        });

        const contactProfilesForm = new SubmitForm('#contactProfileForm');
        contactProfilesForm.attachFile('[name=photo]', createContactProfileData.photo);
        contactProfilesForm.enterText('[name=name]', createContactProfileData.name, ['required']);
        contactProfilesForm.enterText('[name=email]', createContactProfileData.email, ['required']);
        contactProfilesForm.enterText('[name=phone]', createContactProfileData.phone, ['required']);
        contactProfilesForm.customeMultiCheckbox('[name=courses]', createContactProfileData.courses);

        contactProfilesForm.submit();

        cy.php('App\\Models\\ContactProfile::count();').then(contactProfile => {
            expect(contactProfile).to.equal(totalCount + 1);
        });
    });

    it('Search index', () => {
        // Wrong Value check
        cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type('Wrong Value Enter For Test').wait(500);
        cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');

        cy.php('App\\Models\\ContactProfile::latest()->get()->first();').then(contactProfile => {
            // Right Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(contactProfile.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', contactProfile.name);

            // Right half Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(contactProfile.name.slice(0, -1)).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', contactProfile.name);

        });

        cy.wait(500);
    });

    it('Edit without change', () => {
        cy.php('App\\Models\\ContactProfile::latest()->get()->first();').then(contactProfile => {
            let totalCount;
            cy.php('App\\Models\\ContactProfile::count();').then(contactProfileCount => {
                totalCount = contactProfileCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(contactProfile.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', contactProfile.name);
            cy.get("[data-cy=edit-button-" + contactProfile.id + "]:eq(0)").click();

            cy.wait(500);
            const contactProfilesForm = new SubmitForm('#contactProfileForm');
            let columnArray = [['name', 'input'], ['email', 'input'], ['phone', 'input']];
            columnArray.forEach(column => {
                contactProfilesForm.matchValue('[name=' + column[0] + ']', contactProfile[column[0]].toString(), column[1]);
            });
            contactProfilesForm.submit();

            cy.php('App\\Models\\ContactProfile::count();').then(contactProfile => {
                expect(contactProfile).to.equal(totalCount);
            });
        });
    });

    it('Edit with change', () => {
        cy.php('App\\Models\\ContactProfile::latest()->get()->first();').then(contactProfile => {
            let totalCount;
            cy.php('App\\Models\\ContactProfile::count();').then(contactProfileCount => {
                totalCount = contactProfileCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(contactProfile.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', contactProfile.name);
            cy.get("[data-cy=edit-button-" + contactProfile.id + "]:eq(0)").click().wait(500);

            const contactProfilesForm = new SubmitForm('#contactProfileForm');
            contactProfilesForm.attachFile('[name=photo]', editContactProfileData.photo);
            contactProfilesForm.enterText('[name=name]', editContactProfileData.name);
            contactProfilesForm.enterText('[name=email]', editContactProfileData.email);
            contactProfilesForm.enterText('[name=phone]', editContactProfileData.phone);
            contactProfilesForm.customeMultiCheckbox('[name=courses]', editContactProfileData.courses);
            contactProfilesForm.submit();

            cy.php('App\\Models\\ContactProfile::find(' + contactProfile.id + ');').then(contactProfile => {
                // TODO: courses assert check left
                // TODO: Profile photo assert check left Like: remove photo, photo is uploded and show this, photo url load
                let columnArray = ['name', 'email', 'phone'];
                columnArray.forEach(column => {
                    expect(contactProfile[column].toString()).to.equal(editContactProfileData[column]);
                });
            });

            cy.php('App\\Models\\ContactProfile::count();').then(contactProfile => {
                expect(contactProfile).to.equal(totalCount);
            });
        });
    });

    it('Delete', () => {
        cy.php('App\\Models\\ContactProfile::latest()->get()->first();').then(contactProfile => {
            let totalCount;
            cy.php('App\\Models\\ContactProfile::count();').then(contactProfileCount => {
                totalCount = contactProfileCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(contactProfile.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', contactProfile.name);
            cy.get("[data-cy=delete-button-" + contactProfile.id + "]:eq(0)").click();

            // Cancel Button Work
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=cancel-button]:eq(0)").click()

            cy.php('App\\Models\\ContactProfile::count();').then(contactProfile => {
                expect(contactProfile).to.equal(totalCount);
            });

            // Delete Button
            cy.get("[data-cy=delete-button-" + contactProfile.id + "]:eq(0)").click();
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=delete-button]:eq(0)").click().wait(500)
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');
            cy.php('App\\Models\\ContactProfile::count();').then(contactProfile => {
                expect(contactProfile).to.equal(totalCount - 1);
            });
        });
    });
});
