Ext.define('Pc.grid.node_.Progress', {
    extend  : 'Pc.grid.Node',
    alias   : 'widget.grid-progress',
    store   : null,
    frame   : true,
    plugins : [
        {
            ptype           : 'rowediting',
            pluginId        : 'rowediting',
            cancelBtnText 	: t('Anuluj'),
            saveBtnText 	: t('Zapisz'),
            listeners       : {
                edit            : function (editor, event) {},
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
            header      : t('Tytuł'),
            dataIndex   : 'title',
            field       : {
                xtype       : 'textfield',
                allowBlank  : true
            }
        },
        {
            text        : t('Opis'),
            dataIndex   : 'description',
            field       : {
                xtype       : 'textfield',
                allowBlank  : true
            }
        },
        {
            text        : t('Rozpoczęto'),
            dataIndex   : 'started',
            field       : {
                xtype       : 'datefield',
                format      : 'Y-m-d'
            }
        },
        {
            text        : Ext.String.format(t('Zakończono')),
            dataIndex   : 'ended',
            field       : {
                xtype       : 'datefield',
                format      : 'Y-m-d'
            }
        }
    ],
    tbar    : [
        {
            xtype   : 'button-add',
            handler : function (btn) {
                var grid    = btn.up('grid'),
                    record  = Ext.ModelManager.create({}, 'Pc.model.Progress');

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
                    selection   = grid.getView().getSelectionModel();

                if (selection.hasSelection()) {
                    grid.getStore().remove(selection.getSelection()[0]);
                }
            }
        }
    ],
    listeners :{
        afterrender : function (me) {
            me.bindStore(Ext.create('Pc.store.Progress'));
        }
    }
});
