/**
 * Created by t on 8/11/14.
 */
Ext.application({
    name: 'ProgressLogger',
    config: {
        paths: []
    },
    appFolder: 'bundles/codecatscore/js/ext/app',

    launch: function() {
        Application = this;
        this.initViewport(('Pl.viewport.Main'));

    }
});