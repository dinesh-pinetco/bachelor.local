/// <reference types="cypress" />

import {Pagination} from "../../support/page-object/pagination";
import {SubmitForm} from "../../support/page-object/submit-form";

context('Employee for course', () => {
    let employeeCredentials;
    let createCourseData;
    let editCourseData;
    let cloneCourseData;

    before(() => {
        cy.refreshDatabase()
            .seed('DatabaseSeeder');

        cy.fixture('credentials').then(function (data) {
            employeeCredentials = data.employee;
        });

        cy.fixture('course').then(function (data) {
            createCourseData = data.create;
            editCourseData = data.edit;
            cloneCourseData = data.clone;
        });

    });

    beforeEach(() => {
        cy.login({email: employeeCredentials.email});
        cy.visit({route: 'employee.courses.index'});
    });

    it('Pagination', () => {
        // Check Default 10 page row
        new Pagination('App\\Models\\Course', 10, 9);
    });

    it('Pagination change', () => {
        // Check 15 page row
        cy.get("[data-cy=per-page]:eq(0)").should("be.visible").select('15').wait(500)
        new Pagination('App\\Models\\Course', 15, 9);
    });

    it('Create', () => {
        cy.get("[data-cy=table-action]:eq(0)").should("be.visible").contains('Create').click();

        let totalCount;
        cy.php('App\\Models\\Course::count();').then(courseCount => {
            totalCount = courseCount;
        });

        const coursesForm = new SubmitForm('#courseForm');
        coursesForm.enterText('[name=name]', createCourseData.name, ['required', 'min:5', 'max:50']);
        coursesForm.enterText('[name=form_of_study]', createCourseData.form_of_study, ['required']);
        coursesForm.selectDropdown('[name=duration]', createCourseData.duration, ['required']);
        coursesForm.enterText('[name=description]', createCourseData.description, ['required']);
        coursesForm.selectDropdown('[name=is_active]', createCourseData.is_active, ['required']);
        coursesForm.submit();

        cy.php('App\\Models\\Course::count();').then(course => {
            expect(course).to.equal(totalCount + 1);
        });
    });

    it('Create duplicate entry ', () => {
        cy.php('App\\Models\\Course::latest()->get()->first();').then(course => {
            let totalCount;
            cy.php('App\\Models\\Course::count();').then(courseCount => {
                totalCount = courseCount;
            });

            cy.get("[data-cy=table-action]:eq(0)").should("be.visible").contains('Create').click();

            const coursesForm = new SubmitForm('#courseForm');
            coursesForm.enterText('[name=name]', course.name, ['exist']);
            coursesForm.submit();

            cy.php('App\\Models\\Course::count();').then(course => {
                expect(course).to.equal(totalCount);
            });
        });
    });

    it('Search index', () => {
        // Wrong Value check
        cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type('Wrong Value Enter For Test').wait(500);
        cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');

        cy.php('App\\Models\\Course::latest()->get()->first();').then(course => {
            // Right Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(course.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', course.name);

            // Right half Value Check
            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(course.name.slice(0, -1)).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', course.name);

            // Right And Wrong Value Check With Column
            let columnArray = ['name', 'description', 'form_of_study', 'duration'];
            columnArray.forEach(column => {
                // Wrong Value Enter
                cy.get("[data-cy=datatable-column]:eq(0)").should("be.visible").select(column);
                cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type('Wrong Value Enter For Test').wait(500);
                cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');

                // Right Value Enter
                cy.get("[data-cy=datatable-column]:eq(0)").should("be.visible").select(column);
                cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(course[column]).wait(500);
                cy.get('#dataTable tbody').find('tr').should('have.length', 1);
            });
        });
        cy.wait(500);
    });

    it('Clone without change', () => {
        cy.php('App\\Models\\Course::latest()->get()->first();').then(course => {

            let totalCount;
            cy.php('App\\Models\\Course::count();').then(courseCount => {
                totalCount = courseCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(course.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', course.name);
            cy.get("[data-cy=clone-button-" + course.id + "]:eq(0)").click().wait(500);

            const coursesForm = new SubmitForm('#courseForm');
            coursesForm.enterText('[name=name]', course.name, ['exist']);
            coursesForm.submit();

            cy.php('App\\Models\\Course::count();').then(course => {
                expect(course).to.equal(totalCount);
            });
        });
    });

    it('Clone with change', () => {
        cy.php('App\\Models\\Course::latest()->get()->first();').then(course => {

            let totalCount;
            cy.php('App\\Models\\Course::count();').then(courseCount => {
                totalCount = courseCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(course.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', course.name);
            cy.get("[data-cy=clone-button-" + course.id + "]:eq(0)").click().wait(500);

            const coursesForm = new SubmitForm('#courseForm');
            coursesForm.enterText('[name=name]', cloneCourseData.name);
            coursesForm.submit();

            cy.php('App\\Models\\Course::latest()->get()->first();').then(course => {
                let columnArray = ['name'];
                columnArray.forEach(column => {
                    expect(course[column]).to.equal(cloneCourseData[column]);
                });
            });

            cy.php('App\\Models\\Course::count();').then(course => {
                expect(course).to.equal(totalCount + 1);
            });
        });
    });

    it('Edit without change', () => {
        cy.php('App\\Models\\Course::latest()->get()->first();').then(course => {
            let totalCount;
            cy.php('App\\Models\\Course::count();').then(courseCount => {
                totalCount = courseCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(course.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', course.name);
            cy.get("[data-cy=edit-button-" + course.id + "]:eq(0)").click();

            cy.wait(500);
            const coursesForm = new SubmitForm('#courseForm');
            let columnArray = [['name', 'input'], ['description', 'input'], ['form_of_study', 'input'], ['duration', 'select'], ['is_active', 'select']];
            columnArray.forEach(column => {
                coursesForm.matchValue('[name=' + column[0] + ']', course[column[0]].toString(), column[1]);
            });
            coursesForm.submit();

            cy.php('App\\Models\\Course::count();').then(course => {
                expect(course).to.equal(totalCount);
            });
        });
    });

    it('Edit with change', () => {
        cy.php('App\\Models\\Course::latest()->get()->first();').then(course => {
            let totalCount;
            cy.php('App\\Models\\Course::count();').then(courseCount => {
                totalCount = courseCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(course.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', course.name);
            cy.get("[data-cy=edit-button-" + course.id + "]:eq(0)").click().wait(500);

            const coursesForm = new SubmitForm('#courseForm');
            coursesForm.enterText('[name=name]', editCourseData.name);
            coursesForm.enterText('[name=form_of_study]', editCourseData.form_of_study);
            coursesForm.selectDropdown('[name=duration]', editCourseData.duration);
            coursesForm.enterText('[name=description]', editCourseData.description);
            coursesForm.selectDropdown('[name=is_active]', editCourseData.is_active);
            coursesForm.submit();

            cy.php('App\\Models\\Course::find(' + course.id + ');').then(course => {
                let columnArray = ['name', 'description', 'form_of_study', 'duration', 'is_active'];
                columnArray.forEach(column => {
                    expect(course[column].toString()).to.equal(editCourseData[column]);
                });
            });

            cy.php('App\\Models\\Course::count();').then(course => {
                expect(course).to.equal(totalCount);
            });
        });
    });

    it('Delete', () => {
        cy.php('App\\Models\\Course::latest()->get()->first();').then(course => {
            let totalCount;
            cy.php('App\\Models\\Course::count();').then(courseCount => {
                totalCount = courseCount;
            });

            cy.get("[data-cy=table-search]:eq(0)").should("be.visible").clear().type(course.name).wait(500);
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', course.name);
            cy.get("[data-cy=delete-button-" + course.id + "]:eq(0)").click();

            // Cancel Button Work
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=cancel-button]:eq(0)").click()

            cy.php('App\\Models\\Course::count();').then(course => {
                expect(course).to.equal(totalCount);
            });

            // Delete Button
            cy.get("[data-cy=delete-button-" + course.id + "]:eq(0)").click();
            cy.get("[data-cy=confirmation-model]:eq(0)").should("be.visible").find("[data-cy=delete-button]:eq(0)").click().wait(500)
            cy.get('#dataTable tbody').find('tr').should('have.length', 1).should('contain', 'No Data Found');
            cy.php('App\\Models\\Course::count();').then(course => {
                expect(course).to.equal(totalCount - 1);
            });
        });
    });
});
