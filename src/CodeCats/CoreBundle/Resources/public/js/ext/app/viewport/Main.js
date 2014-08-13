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
                /**
                 * Add modules from namespace in sorted order
                 * @param me
                 */
                beforerender: function (me) {
                    var namespace   = 'Pl.module.',
                        length      = namespace.length,
                        sortableBin = [];

                    for (var i in Ext.ClassManager.classes) {
                        if (i.substr(0, length) === namespace) {
                            var module = Ext.create(i);
                            if (module.exclude !== true) {
                                sortableBin.push([module, module.order]);
                            }
                        }
                    }
                    sortableBin.sort(function(a, b) {return b[1] - a[1]});
                    for (var i in sortableBin) {
                        me.add(sortableBin[i][0]);
                    }
                },
                afterrender : function (me) {
                    var tabPanel = me.up('viewport').down('[name=tabpanel]');
                    Pl.ViewportMainNavigator.instance().setTabPanel(tabPanel);
                    Pl.ViewportMainNavigator.instance().setAccordionPanel(me);
                    Pl.ViewportMainNavigator.instance().initializeTabPanelListeners();

                    var firstPanel = null;
                    /**
                     * Add listener to each item in menu accordion. This listener opens
                     * new tab with clicked item title
                     */
                    me.items.each(function (item) {
                        item.el.on('click', function (me) {
                            var panelModule = Pl.ViewportMainNavigator.instance().createModuleView(item);
                            if (Pl.ViewportMainNavigator.instance().isAccordionCollapsed(panelModule)) {
                                Pl.ViewportMainNavigator.instance().tabOpen(panelModule);
                            }
                        });
                        if (firstPanel === null) {
                            firstPanel = Pl.ViewportMainNavigator.instance().createModuleView(item);
                        }
                        Pl.ViewportMainNavigator.instance().tabOpen(firstPanel);
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
            height  : '5%'
        }
    ]
});