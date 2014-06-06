Ext.define('Pc.model.Progress', {
    extend: 'Ext.data.Model',
    fields: [
        'id',
        'title',
        'description',
        'started',
        'startedTime',
        'ended',
        'endedTime',
        'category',
        'category_id',
        'user',
        'user_id',
        'project',
        'project_id'
    ],
    validations: [
        {
            type: 'length',
            field: 'title',
            min: 1
        }
    ],
    associations: [
        {model: 'Pc.model.Category', name: 'category', type: 'hasOne'},
        {model: 'Pc.model.User', name: 'user', type: 'hasOne'},
        {model: 'Pc.model.Project', name: 'project', type: 'hasOne'}
    ]
});
