Ext.define('Pc.store.Progress', {
    extend  : 'Ext.data.Store',
    model   : 'Pc.model.Progress',
    autoLoad: true,
    autoSync: true,
    proxy   : {
        type    : 'rest',
        url     : url('progress'),
        reader: {
            type: 'json',
            root: 'data'
        },
        writer: {
            type: 'json'
        },
        headers: {
            'Content-Type' : 'application/json'
        },
        afterRequest:function(request, success){}
    }
});
