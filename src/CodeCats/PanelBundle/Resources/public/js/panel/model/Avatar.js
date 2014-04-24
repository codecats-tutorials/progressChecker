Ext.define('Pc.model.Avatar', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'path',
        'lastChanged'
    ],
    validations: [
        {
            type: 'path',
            field: 'text',
            min: 1
        }
    ]
});
