/// <reference types="cypress" />
import {Helpers} from './helpers';

export class Validation {
    _element;
    _elementType;
    _elementClearValue = true;

    constructor(validateForm) {
        this.validateForm = cy.get(validateForm);
        this.validateFormID = validateForm + ' ';
    }

    setElementType(value) {
        this._elementType = value;
        this.setElementClearValue();
        return this;
    }

    setElementClearValue() {

        switch (this._elementType) {
            case 'input':
                this._elementClearValue = true;
                break;

            case 'select':
                this._elementClearValue = false;
                break;

            case 'checkbox':
                this._elementClearValue = false;
                break;

            case 'multi-checkbox':
                this._elementClearValue = false;
                break;

            case 'file':
                this._elementClearValue = false;
                break;

            default:
                break;
        }
        return this;
    }

    setValue(value) {
        switch (this._elementType) {
            case 'input':
                this._element.type(value, {parseSpecialCharSequences: false});
                break;

            case 'select':
                this._element.select(value);
                break;

            case 'checkbox':
                this._element.check(value);
                break;

            case 'multi-checkbox':
                this._element.check(value, {force: true});
                break;

            case 'file':
                this._element.selectFile(value, {
                    force: true
                });
                break;

            default:
                break;
        }

        return this;
    }

    setElementWithType(element, type) {
        this.setElement(element, type);
        this.setElementType(type);
        return this;
    }

    shouldValueOk() {
        this._element = this._element.invoke('val').should("be.ok");
        return this;
    }

    shouldMatchValue(value) {
        this._element = this._element.invoke('val').should("equal", value);
        return this;
    }

    setElement(element, type = "") {
        if (type == "multi-checkbox")
            this._element = this.validateForm.find('[data-cy=multiple-dropdown-box]:eq(0)').click().wait(100).parent().find(element);
        else
            this._element = this.validateForm.find(element);
        return this;
    }

    selectValidationRule(rule, value = '') {
        let rules = rule.split(':');

        if (rules[0] == 'exist')
            this[rules[0]](value)
        else {
            if (typeof rules[1] !== 'undefined') {
                this[rules[0]](rules[1])
            } else {
                this[rules[0]]()
            }
        }

        return this;
    }

    elementClear() {
        if (this._elementClearValue == true)
            this._element.clear();

        return this;
    }

    required() {
        this.elementClear();
        return this;
    }

    exist(value) {
        this.elementClear();
        this.setValue(value);
        return this;
    }

    min(size) {
        this.elementClear();
        this.setValue(Helpers.randomString(parseInt(size) - 1));
        return this;
    }

    max(size) {
        this.elementClear();
        this.setValue(Helpers.randomString(parseInt(size) + 1));
        return this;
    }

    // specialCharacters(element) {
    //     cy.get(this.validateFormID + element).clear().type("!#$#@#@FEHWE*#$*(@#HF@(&%");
    //     this.submit();
    //     this.arriseError(this.validateFormID + element);
    // }

    // onlyNumber(element) {
    //     cy.get(this.validateFormID + element).clear().type("AS DAS Daj asiod qhun qgfbg");
    //     this.submit();
    //     this.arriseError(this.validateFormID + element);
    // }

    // onlyAlpha(element) {
    //     cy.get(this.validateFormID + element).clear().type("1237 8173 121279");
    //     this.submit();
    //     this.arriseError(this.validateFormID + element);
    // }

    submit() {
        this.validateForm.find('[type=submit]').click({force: true});
        cy.wait(500);
        return this;
    }

    arriseError() {
        this._element.parent()
            .find('p')
            .should('have.class', 'text-sm')
            .and('have.class', 'text-red')
        return this;
    }

}
