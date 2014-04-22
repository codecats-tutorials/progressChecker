Ext.define('Pc.combobox.Node', {
    extend          : 'Ext.form.field.ComboBox',

    queryMode       : 'local',
    editable        : false,
    displayField    : '',
    valueField      : '',
    store           : null,

    initComponent   : function () {
        this.callParent(arguments);

        if (this.name.search('-inputEl') !== -1) {
            var name = uniCrm.Utilities.camelcase2dash(this.$className);
            this['name'] = name.replace(/.*\.-/g, '');
        }
    }
});