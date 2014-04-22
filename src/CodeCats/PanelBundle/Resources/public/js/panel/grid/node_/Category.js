Ext.define('Pc.grid.node_.Category', {
    extend  : 'Pc.grid.Node',
    alias   : 'widget.grid-category',
    store   : null,
    frame   : true,
    plugins : [
        {
            ptype           : 'rowediting',
            pluginId        : 'rowediting',
            cancelBtnText 	: t('Anuluj'),
            saveBtnText 	: t('Zapisz'),
            listeners       : {
                edit            : function (editor, event) {
                    var gridStore = event.view.up('grid').getStore();
                    gridStore.reload();
                },
                cancelEdit      : function (editor, event) {
                    var gridStore = event.view.up('grid').getStore();
                    if ( ! gridStore.getAt(0).get('id')) gridStore.removeAt(0);
                }
            }
        }
    ],
    columns : [
        {
            header      : t('Id'),
            dataIndex   : 'id',
            field       : {
                xtype       : 'numberfield',
                readOnly    : true,
                allowBlank  : true
            }
        },
        {
            header      : t('Nazwa'),
            dataIndex   : 'name',
            field       : {
                xtype       : 'textfield',
                allowBlank  : true
            }
        }
    ],
    tbar    : [
        {
            xtype   : 'button-add',
            handler : function (btn) {
                var grid    = btn.up('grid'),
                    record  = Ext.ModelManager.create({}, 'Pc.model.Category');

                grid.getStore().insert(0, record);
                grid.getPlugin('rowediting').startEdit(0, 0);
            }
        },
        {
            xtype : 'button-edit',
            handler : function (btn) {
                var grid    = btn.up('grid'),
                    selection   = grid.getView().getSelectionModel();

                if (selection.hasSelection()) {
                    grid.editingPlugin.startEdit(selection.getSelection()[0], 0);
                }
            }
        },
        {
            xtype : 'button-delete',
            handler: function (btn){
                var grid        = btn.up('grid'),
                    selection   = grid.getSelectionModel();

                if (selection.getLastFocused()) {
                    grid.getStore().remove(selection.getLastFocused());
                }
            }
        }
    ],
    listeners :{
        afterrender : function (me) {
            me.bindStore(Ext.create('Pc.store.Category'));
        }
    }
});
