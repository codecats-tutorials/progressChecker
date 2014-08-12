Ext.define('Pl.viewport.Main', {
    extend: 'Ext.container.Viewport',
    layout: 'border',
    items : [
        {
            name    : 'header',
            xtype   : 'pl-header'
        },
        {
            name    : 'navigation',
            xtype   : 'panel',
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
                    glyph       : '9798@',
                    itemsModule : [

                        {
                            xtype: 'button',
                            text: 'ye1',
                            flex: 1
                        },
                        {
                            xtype: 'button',
                            text: 'ye2',
                            flex: 1
                        },
                        {
                            html: 'lab'+window.label,
                            flex: 1
                        }
                    ]
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
            ],
            listeners : {
                afterrender : function(me) {
                    var tabPanel = me.up('viewport').down('[name=tabpanel]');
                    Pl.ViewportMainNavigator.instance().setTabPanel(tabPanel);

                    /**
                     * Add listener to each item in menu accordion. This listener opens
                     * new tab with clicked item title
                     */
                    me.items.each(function (item) {
                        item.el.on('click', function (me) {
                            var panelModule = new Ext.Panel({
                                layout  : 'hbox',
                                closable: true,
                                title   : item.title,
                                /**
                                 * Unique identification of module. It's easy to check for example
                                 * if module is already opened
                                 */
                                moduleId: item.id,
                                //main components of the module
                                items   : item.itemsModule
                            });
                            Pl.ViewportMainNavigator.instance().accordionOpen(panelModule);

                        });
                    });

                }
            }
        },
        {
            region  : 'center',
            xtype   : 'tabpanel',
            name    : 'tabpanel',
            items: []
        },
        {
            xtype   : 'panel',
            region  : 'south',
            title   : 'll',
            height  : '100px'
        }
    ]
});