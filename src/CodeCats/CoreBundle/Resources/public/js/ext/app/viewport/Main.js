Ext.define('Pl.viewport.Main', {
    extend: 'Ext.container.Viewport',
    //xtype: 'viewport',
    layout: 'border',
    formulas: {
        fullName: function (get) {
            return ('firstName') + ' ' + ('lastName');
        },
        name: '3'
    },
    items : [
        /*{
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
                            xtype   : 'grid-progress'
                        }
                    ]
                },
                {
                    title : t('Projekty'),
                    items : [
                        {
                            xtype   : 'grid-project'
                        }
                    ]
                },
                {
                    title : t('Języki'),
                    items : [
                        {
                            xtype   : 'grid-category'
                        }
                    ]
                }
            ]
        },
        {
            xtype   : 'panel',
            region  : 'south',
            title   : 'll'
        }*/
    ]
});