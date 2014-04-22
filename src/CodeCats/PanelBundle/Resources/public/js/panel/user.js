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
        if (name.substring(0, 'user'.length) === 'user') {
            //dash convert to CamelCase
            name = name.replace('user-', '');
            name = name.split('-');
            for (var i = 1; i < name.length; ++i)
                name[i] = name[i].charAt(0).toUpperCase() + name[i].slice(1);
            name = name.join('');
            this['_values'][name] = value;

            return this;
        }

    },

    get     : function (name) {
        return this._values[name];
    },
    _setValues   : function () {
        var userAttr = Ext.getBody().down('section[id=user]').dom.attributes;
        for (var i in userAttr) {
            if (typeof(userAttr[i].name) !== 'undefined')
                this.set(userAttr[i].name, userAttr[i].value);
        }
    },
    hasAccess   : function (name) {
        var acl = this.get('acl');
        if ( ! acl) return uniCrm.ServiceAcl.ALLOW_NOT_SET;
        return (acl.indexOf(name) !== -1);
    }
});