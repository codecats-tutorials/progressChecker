/**
 * Created by t on 8/11/14.
 */
Ext.application({
    name            : 'ProgressLogger',
    config          : {
        paths           : []
    },
    appFolder       : 'bundles/codecatscore/js/ext/app',
    autoCreateViewport: 'Pl.viewport.Main',

    /**
     * Logic on the bottom of components
     */
    launch          : function() {
        Application = this;
        //remove loading content
        Ext.get('load').remove();
    }
});