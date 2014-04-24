Ext.define('Pc.store.Phone', {
    extend  : 'Ext.data.Store',
    model   : 'Pc.model.Phone',
    autoLoad: true,
    autoSync: true,
    proxy   : {
        type    : 'rest',
        url     : url('phone'),
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
