Ext.define('Pc.store.Category', {
    extend  : 'Ext.data.Store',
    model   : 'Pc.model.Category',
    autoLoad: true,
    autoSync: true,
    proxy   : {
        type    : 'rest',
        url     : url('category'),
        reader: {
            type: 'json',
            root: 'data'
        },
        writer: {
            type: 'json'
        },
        headers: {
            'Content-Type' : 'application/json'
        }
    }
});
