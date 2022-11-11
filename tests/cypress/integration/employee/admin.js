/// <reference types="cypress" />

context('Employee for admin', () => {
    before(() => {
        cy.refreshDatabase()
            .seed('DatabaseSeeder');
    })

    beforeEach(() => {
        cy.fixture('credentials').then(function (data) {
            cy.login({email: data.employee.email});
        })
    })

    describe('Navagation bar check', () => {
        it('check total bar is activated', () => {
            cy.visit({route: 'employee.dashboard'});
            cy.get('nav ul.sidebar-menu li').should(($lis) => {
                expect($lis, '9 items').to.have.length(10)
                expect($lis.eq(0), 'first item').to.contain('Dashboard')
                expect($lis.eq(1), 'second item').to.contain('Profile')
                expect($lis.eq(2), 'third item').to.contain('Applicants')
                expect($lis.eq(3), 'fourth item').to.contain('Courses')
                expect($lis.eq(4), 'fifth item').to.contain('Documents')
                expect($lis.eq(5), 'sixth item').to.contain('Tests')
                expect($lis.eq(6), 'seventh item').to.contain('Groups')
                expect($lis.eq(7), 'eighth item').to.contain('Settings')
                expect($lis.eq(8), 'nineth item').to.contain('Contact profiles')
                expect($lis.eq(9), 'tenth item').to.contain('Faq')
            })
        })
        it('check navigation bar link redirection', () => {
            const pages = ['Courses', 'Profile', 'Documents', 'Tests', 'Groups', 'Settings', 'Contact profiles', 'Faq']
            pages.forEach(page => {
                cy.contains(page).click()
                cy.wait(200);
                cy.location().should((loc) => {
                    let pathname = page.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '')
                    if (page == 'Settings') {
                        expect(loc.pathname).to.eq('/employee/settings/fields/profile')
                    } else if (page == 'Groups') {
                        expect(loc.pathname).to.eq('/employee/settings/groups/profile')
                    } else {
                        expect(loc.pathname).to.eq('/employee/' + pathname)
                    }
                    expect(loc.search).to.eq('?search=')
                })
            })
        })

        it('check logout link', () => {
            cy.visit({route: 'employee.courses.index'});
            cy.get('a.w-10').click()
        })
    })
});
