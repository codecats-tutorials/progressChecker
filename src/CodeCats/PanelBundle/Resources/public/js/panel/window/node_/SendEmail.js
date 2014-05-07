Ext.define('Pc.window.node_.SendEmail', {
    extend  : 'Pc.window.Node',
    title   : t('Wyślij e-mail'),
    items   : [
        {
            title       : t('Konto firmowe e-mail'),
            xtype       : 'form',
            frame       : true,
            autoScroll  : true,
            margin      : '30%',
            defaults    : {
                anchor: '90%'
            },
            url         : url('send/email'),
            items       : [
                {
                    xtype       : 'textfield',
                    name        : 'subject',
                    fieldLabel  : t('Temat')
                },
                {
                    xtype       : 'textareafield',
                    name        : 'body',
                    fieldLabel  : t('Treść')
                },
                {
                    xtype       : 'textfield',
                    name        : 'receiver1',
                    fieldLabel  : t('Odbiorca 1')
                },
                {
                    xtype       : 'textfield',
                    name        : 'receiver2',
                    fieldLabel  : t('Odbiorca 2')
                },
                {
                    xtype       : 'textfield',
                    name        : 'receiver3',
                    fieldLabel  : t('Odbiorca 3')
                }
            ],
            buttons: [
                {
                    xtype: 'button',
                    text: t('Wyślij'),
                    handler: function (me) {
                        var form = me.up('window').down('form');

                        if (form.getForm().isValid()) {
                            form.getForm().submit();
                        }
                    }
                }
            ]
        }
    ]
});
