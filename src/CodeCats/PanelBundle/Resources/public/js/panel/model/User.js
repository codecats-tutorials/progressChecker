Ext.define('Pc.model.User', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'username',
        'password',
        'email'
    ],
    validations: [
        {
            type: 'length',
            field: 'username',
            min: 1
        }
    ]
});
