Ext.define('Pc.store.User', {
    extend  : 'Ext.data.Store',
    model   : 'Pc.model.User',
    autoLoad: true,
    autoSync: true,
    proxy   : {
        type    : 'rest',
        url     : url('user'),
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
