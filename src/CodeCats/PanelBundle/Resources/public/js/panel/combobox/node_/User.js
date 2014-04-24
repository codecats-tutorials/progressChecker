Ext.define('Pc.combobox.node_.User', {
    extend          : 'Pc.combobox.Node',
    alias           : 'widget.combobox-user',
    editable        : true,
    displayField    : 'username',
    valueField      : 'id',
    store           : null,
    fieldLabel      : t('Użytkownik'),

    initComponent   : function () {
        this.store = Ext.create('Pc.store.User');

        this.callParent(arguments);
    }
});