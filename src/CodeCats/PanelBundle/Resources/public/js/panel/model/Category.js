Ext.define('Pc.model.Category', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'name',
        'description'
    ],
    validations: [
        {
            type: 'length',
            field: 'name',
            min: 1
        }
    ]
});
