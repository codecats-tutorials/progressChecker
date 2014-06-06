Ext.define('Pc.combobox.node_.Project', {
    extend          : 'Pc.combobox.Node',
    alias           : 'widget.combobox-project',
    editable        : true,
    displayField    : 'name',
    valueField      : 'id',
    store           : null,
    fieldLabel      : t('Projekt'),

    initComponent   : function () {
        this.store = Ext.create('Pc.store.Project');

        this.callParent(arguments);
    }
});