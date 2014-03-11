Ext.define('Pc.viewport.Panel', {
    extend: 'Ext.container.Viewport',
    layout: 'border',
    items : [
        {
            xtype   : 'pc-header'
        },
        {
            region  : 'center',
            xtype   : 'tabpanel',
            items   : [
                {
                    title : t('Postęp'),
                    items : [
                        {
                            xtype : 'button-add',
                            handler : function () {
                                var st = Ext.create('Pc.store.Progress');
                                window['st'] = st;
                            }
                        },
                        {
                            xtype   : 'grid-node',
                            store   : null,
                            columns : [
                                {
                                    text        : 'ID',
                                    dataIndex   : 'id'
                                }
                            ],
                            listeners :{
                                afterrender : function (me) {
                                    console.log('a');
                                    me.bindStore(Ext.create('Pc.store.Progress'));
                                }
                            }
                        }
                    ]
                },
                {
                    title   : t('Języki')
                }
            ]
        },
        {
            xtype   : 'panel',
            region  : 'south',
            title   : 'll'
        }
    ]
});
