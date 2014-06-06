Ext.define('Pc.store.Project', {
    extend  : 'Ext.data.Store',
    model   : 'Pc.model.Project',
    autoLoad: true,
    autoSync: true,
    proxy   : {
        type    : 'rest',
        url     : url('project'),
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
