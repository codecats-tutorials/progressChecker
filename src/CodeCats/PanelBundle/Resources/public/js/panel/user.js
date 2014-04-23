/**
 * Created by t on 27.12.13.
 */
Ext.define('Pc.User', {
    config          : {
    },
    statics         : {
    },
    _values         : {
    },
    constructor     : function (config) {
        this.callParent(arguments);
        Ext.apply(this, config);

        this._setValues();
        var string = this.get('acl');
        if ( ! string) string = null;
        else string = JSON.parse(string);
        this._values['acl'] = string;
    },

    logout  : function () {
        location.href   = 'index/logout';
    },
    set         : function (name, value) {
        this['_values'][name] = value;
    },

    get     : function (name) {
        return this._values[name];
    },
    _setValues   : function () {
        var userAttr = JSON.parse(document.querySelector('#user').innerHTML);
        for (var i in userAttr) {
            this.set(i, userAttr[i]);
        }
    }
});