/// <reference types="cypress" />

export class Pagination {
    model;
    pageRecordCount;
    totalCount;

    constructor(model, pageRecordCount, totalCount) {
        this.model = model;
        this.pageRecordCount = pageRecordCount;
        this.totalCount = totalCount;

        let firstRecord = 1;

        let expectRecordCount = this.pageRecordCount < this.totalCount ? this.pageRecordCount : this.totalCount;
        let lastRecord = ((firstRecord + this.pageRecordCount) - 1) > this.totalCount ? this.totalCount : ((firstRecord + this.pageRecordCount) - 1);
        let newLastRecord;
        let totalPage = Math.ceil(this.totalCount / this.pageRecordCount);
        cy.php(this.model + '::count();').then(course => {
            expect(course).to.equal(this.totalCount);
        });

        for (let page = 1; page <= totalPage; page++) {
            if (page != 1) {
                firstRecord = lastRecord + 1;
                newLastRecord = ((firstRecord + this.pageRecordCount) - 1) > this.totalCount ? this.totalCount : ((firstRecord + this.pageRecordCount) - 1);
                expectRecordCount = newLastRecord - lastRecord;
                lastRecord = newLastRecord;
            }

            cy.get('#dataTable tbody').find('tr').should('have.length', expectRecordCount);

            if (page != 1)
                cy.contains("Showing " + firstRecord + " to " + lastRecord + " of " + this.totalCount + " results")

            if (totalPage != page) {
                cy.get('button[rel="next"]').click();
                cy.wait(100);
            }
        }
    }
}
