Ext.define('Pc.model.Project', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'name',
        'description',
        'dateStarted',
        'timeStarted',
        'dateEnded',
        'timeEnded',
        'dateDeadline',
        'timeDeadline'
    ],
    validations: [
        {
            type: 'length',
            field: 'name',
            min: 1
        }
    ]
//    ,
//    associations: [
//        {model: 'Pc.model.Category', name: 'category', type: 'hasOne'},
//        {model: 'Pc.model.User', name: 'user', type: 'hasOne'}
//    ]
});
