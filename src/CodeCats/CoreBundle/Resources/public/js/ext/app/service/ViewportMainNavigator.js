/**
 * Logic for the main viewport
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
        tabPanel    : null
    },
    constructor     : function (config) {
        this.callParent(arguments);
        Ext.apply(this, config);
        this.initialize();
    },
    initialize      : function () {
        var me = this;
        me.logWho();
        me.setCreatedTabs([])
    },
    logWho          : function () {
        console.log('Service: ' + Pl.ViewportMainNavigator.$className);
    },
    accordionOpen   : function(panelModule) {
        if (this.isOpened(panelModule) === false) {
            this.addCloseListener(panelModule);
            this.getTabPanel().add(panelModule);
            this.getCreatedTabs().push(panelModule);
        }

        if (this.isActiveTab(panelModule) === false) {
            this.activateTab(panelModule);
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
    }
});
