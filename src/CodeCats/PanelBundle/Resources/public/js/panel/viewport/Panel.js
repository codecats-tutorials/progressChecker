Ext.define('Pc.viewport.Panel', {
    extend: 'Ext.container.Viewport',
    layout: 'border',
    items : [
		{
                    region : 'north',
                    xtype: 'button',
                    text : 'aaa'
		},
                {
                    region: 'north',
                    xtype:'button-node'
                }
    ]
});
