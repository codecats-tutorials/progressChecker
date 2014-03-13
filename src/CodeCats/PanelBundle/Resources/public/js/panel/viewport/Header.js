Ext.define('Pc.viewport.Header', {
    extend      : 'Ext.Toolbar',
    alias       : 'widget.pc-header',
    region      : 'north',
    border      : 'vbox',
    title       : 'abc',
    items       : [
        {
            html : 'aaa'
        },
        '->',
        {
            xtype : 'button',
            text:'AJAX',
            handler : function () {
                Ext.Ajax.request({
                    method  : 'PUT',
                    url     : 'progress',
                    params  : {
                        title : 'TTT'
                    }
                });
            }
        }
    ]
});