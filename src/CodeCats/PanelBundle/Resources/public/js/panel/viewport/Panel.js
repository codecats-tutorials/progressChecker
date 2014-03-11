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
                            xtype : 'button-add'
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
