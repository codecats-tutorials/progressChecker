Ext.define('Pc.model.Category', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'name'
    ],
    validations: [
        {
            type: 'length',
            field: 'name',
            min: 1
        }
    ]
});
