Ext.define('Pc.store.Progress', {
    extend  : 'Ext.data.Store',
    model   : 'Pc.model.Progress',
    autoLoad: true,
    autoSync: true,
    model   : 'Pc.model.Progress',
    proxy   : {
        type    : 'rest',
        url     : url('progress'),
        reader: {
            type: 'json',
            root: 'data'
        },
        writer: {
            type: 'json'
        }
    }
});
