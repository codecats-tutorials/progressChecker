Ext.define('Pc.store.Avatar', {
    extend  : 'Ext.data.Store',
    model   : 'Pc.model.Avatar',
    autoLoad: true,
    autoSync: true,
    proxy   : {
        type    : 'rest',
        url     : url('avatar'),
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
