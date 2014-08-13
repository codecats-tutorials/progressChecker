/**
 * Created by t on 8/13/14.
 */
Ext.define('Pl.module.Module', {
    extend      : 'Ext.panel.Panel',
    //module order. Bigger number, orders first
    order       : 0,
    //trigger to turn off automatic adding
    exclude     : true,
    //title has to be overrided
    title       : '[module]',
    alias       : 'widget.pl-module',
    html        : null,
    border      : true,
    autoScroll  : false,
    iconCls     : 'icon-small-fat-cow-script_code',
    /*glyph       : '9898@'*/
    //items inside main content
    itemsModule : [],
    //items under the tab
    items       : []
});