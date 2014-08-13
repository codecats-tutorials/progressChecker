/**
 * Logic for the main viewport. Main responsibility is to switching accordions and tabs.
 */
Ext.define('Pl.ViewportMainNavigator', {
    statics         : {
        me : null,
        instance : function() {
            if(Pl.ViewportMainNavigator.me === null) {
                Pl.ViewportMainNavigator.me = Ext.create('Pl.ViewportMainNavigator');
            }
    
            return Pl.ViewportMainNavigator.me;
        }
    },
    config         : {
        createdTabs : null,
        tabPanel    : null,
        accordionPanel: null
    },
    constructor     : function (config) {
        this.callParent(arguments);
        Ext.apply(this, config);
        this.initialize();
    },
    initialize      : function () {
        var me = this;
        me.logWho();
        me.setCreatedTabs([]);
    },
    initializeTabPanelListeners: function () {
        var tabPanel    = this.getTabPanel(),
            navigator   = this;

        tabPanel.addListener('tabchange', function (tabPanel, tab) {
            if (navigator.isAccordionCollapsed(tab) === false) {
                navigator.accordionCollapse(tab)
            }
        });
    },
    logWho          : function () {
        console.log('Service: ' + Pl.ViewportMainNavigator.$className);
    },
    tabOpen   : function(panelModule) {
        if (this.isOpened(panelModule) === false) {
            this.addCloseListener(panelModule);
            this.getTabPanel().add(panelModule);
            this.getCreatedTabs().push(panelModule);
        }

        if (this.isActiveTab(panelModule) === false) {
            this.activateTab(panelModule);
        }

        if (this.isAccordionCollapsed(panelModule) === false) {
            this.accordionCollapse(panelModule)
        }
    },
    isOpened        : function (module) {
        var tabs = this.getCreatedTabs();

        for (var i in tabs) {
            if (tabs[i].moduleId === module.moduleId) {

                return true;
            }
        }

        return false;
    },
    isActiveTab     : function (module) {
        var active = this.getTabPanel().getActiveTab();
        if (active === null || typeof active.moduleId === 'undefined') {

            return false;
        }

        return (active.moduleId === module.moduleId);
    },
    activateTab     : function (module) {
        this.getTabPanel().setActiveTab(this.findStoredModule(module));
    },
    findStoredModule: function (module) {
        var tabs = this.getCreatedTabs();

        for (var i in tabs) {
            if (tabs[i].moduleId === module.moduleId) {
                return tabs[i];
            }
        }

        return null;
    },
    findStoredPosition: function (module) {
        var tabs = this.getCreatedTabs();

        for (var i in tabs) {
            if (tabs[i].moduleId === module.moduleId) {
                return i;
            }
        }

        return null;
    },
    /**
     * find position in stored container and remove item on close
     */
    addCloseListener: function (module) {
        var navigator = this;
        module.on('close', function () {
            var position = navigator.findStoredPosition(module);
            if (position !== null) {
                navigator.getCreatedTabs().splice(position, 1);
            }
        });
    },
    accordionCollapse       : function (module) {
        var accordion = this.getAccordion(module);

        if (accordion !== null) {

            return accordion.toggleCollapse();
        }

        return false;
    },
    getAccordion            : function (module) {
        var tabs = this.getAccordionPanel().items;
        for (var i in tabs.items) {
            if (tabs.items[i].id === module.moduleId) {
                return tabs.getAt(i);
            }
        }

        return null;
    },
    getAccordionCollapsed   : function () {
        var tabs = this.getAccordionPanel().items;
        for (var i in tabs.items) {
            if (tabs.items[i].collapsed === false) {
                return tabs.getAt(i);
            }
        }

        return null;
    },
    isAccordionCollapsed    : function (module) {
        var accordion = this.getAccordionCollapsed();
        if (accordion === null) {
            return false;
        }

        return (accordion.id === module.moduleId);
    },
    createModuleView        : function (module) {
        return new Ext.Panel({
            layout  : 'hbox',
            closable: true,
            title   : module.title,
            /**
             * Unique identification of module. It's easy to check for example
             * if module is already opened
             */
            moduleId: module.id,
            //main components of the module
            items   : module.itemsModule
        })
    }
});
