Ext.define('Pc.model.Progress', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'title',
        'description',
        'started',
        'ended'
    ],
    validations: [
        {
            type: 'length',
            field: 'title',
            min: 1
        }
    ]
});
