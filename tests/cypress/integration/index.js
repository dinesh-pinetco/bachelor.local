/// <reference types="cypress" />

import {SubmitForm} from "../support/page-object/submit-form";

context('Index Page', () => {
    before(() => {
        cy.refreshDatabase()
            .seed('DatabaseSeeder');
    })

    describe('New User Auth Check', () => {
        it('Visit Home Page', () => {
            cy.visit('/');
        });

        // Not Working Error Code 419
        // describe('Register New User', () => {
        //     const form = new SubmitForm('#application_register');
        //     it('submit application all empty filed', () => {
        //         form.selectForm('#application_register');
        //         form.selectDropdown('[name=course_id]', 1);
        //         form.selectDropdown('[name=desired_beginning_id]', 1);
        //         form.enterText('[name=first_name]', 'Dipak');
        //         form.enterText('[name=last_name]', 'Gavali');
        //         form.enterText('[name=email]', 'drgavali9@gmail.com');
        //         form.enterText('[name=phone]', '+91 9173921432');
        //         form.submit();
        //     })
        // })
    });

    describe('Admin Auth Check', () => {
        it('Admin login use html form', () => {
            cy.visit('/login')
            const form = new SubmitForm('#loginForm');
            cy.fixture('credentials').then(function (data) {
                form.enterText('[name=email]', data.employee.email);
                form.enterText('[name=password]', data.employee.password);
            })
            form.submit();
            cy.visit('/employee/courses/create');
            cy.get('.stroke-current').click();
        })
    })
});
