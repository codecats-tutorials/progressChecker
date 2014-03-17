Ext.define('Pc.grid.node_.Progress', {
    extend  : 'Pc.grid.Node',
    alias   : 'widget.grid-progress',
    store   : null,
    frame   : true,
    plugins : [
        {
            ptype : 'cellediting',
            clicksToEdit: 1
        }
    ],
    columns : [
        {
            header      : t('Id'),
            dataIndex   : 'id',
            field       : {
                xtype       : 'numberfield',
                readOnly    : true,
                allowBlank  : false
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
                allowBlank  : false
            }
        },
        {
            text        : t('Rozpoczęto'),
            dataIndex   : 'started',
            field       : {
                xtype       : 'datefield',
                format      : 'Y-d-m'
            }
        },
        {
            text        : t('Zakończono'),
            dataIndex   : 'ended',
            field       : {
                xtype       : 'datefield',
                format      : 'Y-d-m'
            }
        }
    ],
    tbar    : [
        {
            xtype : 'button-add'
        },
        {
            xtype : 'button-edit'
        },
        {
            xtype : 'button-delete'
        }
    ],
    listeners :{
        afterrender : function (me) {
            me.bindStore(Ext.create('Pc.store.Progress'));
        }
    }
});
