Ext.define('Pc.model.User', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'username',
        'password',
        'email',
        'phone',
        'phone_id'
    ],
    validations: [
        {
            type: 'length',
            field: 'username',
            min: 1
        }
    ],
    associations: [
        {model: 'Pc.model.Phone', name: 'phones', type: 'hasMany'}
    ]
});
