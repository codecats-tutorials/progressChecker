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
            text        : Ext.String.format(t('Rozpoczęto')),
            dataIndex   : 'startedTime',
            field       : {
                xtype       : 'timefield',
                format      : 'H:i'
            }
        },
        {
            text        : Ext.String.format(t('Zakończono')),
            dataIndex   : 'ended',
            field       : {
                xtype       : 'datefield',
                format      : 'Y-m-d'
            }
        },
        {
            text        : Ext.String.format(t('Zakończono')),
            dataIndex   : 'endedTime',
            field       : {
                xtype       : 'timefield',
                format      : 'H:i'
            }
        },
        {
            text        : t('Kategoria'),
            dataIndex   : 'category_id',
            field       : {
                xtype       : 'combobox-category',
                fieldLabel  : null
            },
            renderer    : function (txt, metaData, record) {
                window.re = record;
                if ( ! record.get('category')) return txt;


                return record.get('category').name;
            }
        },
        {
            text        : t('Użytkownik'),
            dataIndex   : 'user_id',
            field       : {
                xtype       : 'combobox-user',
                fieldLabel  : null
            },
            renderer    : function (txt, metaData, record) {
                if ( ! record.get('user')) return txt;

                return record.get('user').username;
            }
        },
        {
            text        : t('Projekt'),
            dataIndex   : 'project_id',
            field       : {
                xtype       : 'combobox-project',
                fieldLabel  : null
            },
            renderer    : function (txt, metaData, record) {
                if ( ! record.get('project')) return txt;

                return record.get('project').name;
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

                if (selection.getLastFocused()) {
                    grid.getStore().remove(selection.getLastFocused());
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
