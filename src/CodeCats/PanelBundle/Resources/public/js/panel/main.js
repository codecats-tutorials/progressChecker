
Ext.application({
    name    : 'Pc',
    appFolder: 'bundles/codecatspanel/js/panel',
    
    config 	: {
		viewport : null
    },
    
    launch: function() {
        Application = this;
        this.setViewport(Ext.create('Pc.viewport.Panel'));
    }
});
