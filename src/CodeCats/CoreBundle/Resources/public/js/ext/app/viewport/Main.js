Ext.define('Pl.viewport.Main', {
    extend: 'Ext.container.Viewport',
    layout: 'border',
    items : [
        {
            name    : 'header',
            xtype   : 'pl-header'
        },
        {
            name    : 'menu',
            title   : 'Menu',
            region  : 'west',
            animCollapse: true,
            width   : '20%',
            split   : true,
            collapsible: true,
            layout  : {
                type    : 'accordion',
                animate : true
            },
            header  : {
                itemPosition: 1,
                items       : [
                    {
                        xtype   : 'splitbutton',
                        text    : 'Options',
                        menu    : [
                            {
                                text: 'Jira'
                            }
                        ]
                    }
                ]
            },
            items: [
                {
                    html        : '<div class="portlet-content">aaaaa</div>',
                    title       :'Postęp',
                    autoScroll  : true,
                    border      : false,
                    glyph       : '9798@'
                },
                {
                    title       :'Projekty',
                    html        : '<div class="portlet-content">bbbbb</div>',
                    border      : false,
                    autoScroll  : true,
                    iconCls     : 'settings'
                },
                {
                    title       : 'Język',
                    html        : '<div class="portlet-content">icon</div>',
                    border      : false,
                    autoScroll  : true,
                    iconCls     : 'settings'
                }
            ]
        },
        {
            region  : 'center',
            xtype   : 'tabpanel',
            name    : 'tab',
            items: [
            ]
        },
        {
            xtype   : 'panel',
            region  : 'south',
            title   : 'll'
        }
    ]
});