Ext.define('Pc.combobox.node_.Category', {
    extend          : 'Pc.combobox.Node',
    alias           : 'widget.combobox-category',
    editable        : true,
    displayField    : 'name',
    valueField      : 'id',
    store           : null,
    fieldLabel      : t('Kategoria'),

    initComponent   : function () {
        this.store = Ext.create('Pc.store.Category');

        this.callParent(arguments);
    }
});