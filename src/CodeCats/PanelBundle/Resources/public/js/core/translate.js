(function () {
    CodeCats.translation = function () {
        this.__init();
    };
    CodeCats.translation.prototype = {
        __init: function() {
            var user = JSON.parse(document.querySelector('#user').innerHTML);
            this.locale = user.locale;
        },
        locale: 'en',
        translate: function (toTranslate, locale) {
            if (typeof(locale) === 'undefined') locale = this.locale;

            return (I18n[locale][toTranslate] === undefined) ? toTranslate : I18n[locale][toTranslate];
        }
    };
    CodeCats.translation.getInstance = function () {
        if (this.instance === undefined) {
            this.instance = new CodeCats.translation();
        }

        return this.instance;
    };
}) ();

//shortcut
function t(txt, locale) { return CodeCats.translation.getInstance().translate(txt, locale); };