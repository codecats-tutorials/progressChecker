Ext.define('Pc.model.Phone', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'number',
        'type',
        'user',
        'user_id'
    ],
    validations: [
        {
            type: 'length',
            field: 'number',
            min: 1
        }
    ],
    associations: [
        {model: 'Pc.model.User', name: 'users', type: 'hasMany'}
    ]
});
