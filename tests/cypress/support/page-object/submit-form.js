/// <reference types="cypress" />

import {Validation} from "./validation";

export class SubmitForm {
    form;

    constructor(form) {
        this.form = form;
    }

    selectDropdown(element, value, rules = []) {
        if (rules.length > 0) {
            rules.forEach(rule => {
                this.#checkValidation(element, value, 'select', rule);
            });
        }
        this.#setValue(element, value, 'select');
    }

    customeMultiCheckbox(element, value, rules = []) {
        if (rules.length > 0) {
            rules.forEach(rule => {
                this.#checkValidation(element, value, 'multi-checkbox', rule);
            });
        }
        this.#setValue(element, value, 'multi-checkbox');
    }

    enterText(element, value, rules = []) {
        if (rules.length > 0) {
            rules.forEach(rule => {
                this.#checkValidation(element, value, 'input', rule);
            });
        }
        this.#setValue(element, value, 'input');
    }

    attachFile(element, value, rules = []) {
        if (rules.length > 0) {
            rules.forEach(rule => {
                this.#checkValidation(element, value, 'file', rule);
            });
        }
        this.#setValue(element, value, 'file');
    }

    matchValue(element, value, type) {
        new Validation(this.form).setElementWithType(element, type).shouldMatchValue(value);
    }

    submit() {
        new Validation(this.form).submit();
    }

    #setValue(element, value, type) {
        new Validation(this.form).setElementWithType(element, type).elementClear().setValue(value).shouldValueOk();
    }

    #checkValidation(element, value, type, rule) {
        cy.log(rule + ' validation start for ' + element);

        this.#setValidationRuleValue(element, value, type, rule);
        this.submit();
        this.#checkError(element, type);

        cy.log(rule + ' validation end for ' + element);
    }

    #setValidationRuleValue(element, value, type, rule) {
        new Validation(this.form).setElementWithType(element, type).selectValidationRule(rule, value);
    }

    #checkError(element, type) {
        new Validation(this.form).setElementWithType(element, type).arriseError();
    }
}
