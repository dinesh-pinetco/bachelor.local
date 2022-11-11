/// <reference types="cypress" />

export class Helpers {
    _alphaCapital = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    _alphaSmall = "abcdefghijklmnopqrstuvwxyz";
    _numeric = "0123456789";
    _specialChar = "~!@#$%^&*()_+{}|:\"<>?*/+`-=[]\\;',./ ";

    static randomString(length) {
        console.log(length);
        var randomChars = new this()._alphaCapital + new this()._alphaSmall + new this()._numeric + new this()._specialChar;
        return new this().#generateString(randomChars, length);
    }

    static numericString(length) {
        var randomChars = new this()._numeric;
        return new this().#generateString(randomChars, length);
    }

    static alphabeticalString(length) {
        var randomChars = new this()._alphaCapital + new this()._alphaSmall;
        return new this().#generateString(randomChars, length);
    }

    static alphaNumericString(length) {
        var randomChars = new this()._alphaCapital + new this()._alphaSmall + new this()._numeric;
        return new this().#generateString(randomChars, length);
    }

    #generateString(randomChars, length) {
        let result = '';
        for (let i = 0; i < length; i++) {
            result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
        }
        return result;
    }
}
