Ext.define('Pc.window.node_.Profile', {
    extend: 'Pc.window.Node',
    title: t('Twoje konto'),
    items: [
        {
            xtype   : 'form',
            frame       : true,
            autoScroll  : true,
            margin  : '30%',
            defaults: {
                anchor: '90%'
            },
            url     : url('user'),
            items   : [
                {
                    xtype       : 'textfield',
                    name        : 'username',
                    fieldLabel  : t('Nazwa')
                },
                {
                    xtype       : 'textfield',
                    name        : 'email',
                    fieldLabel  : t('Email'),
                    vtype       : 'email'
                },
                {
                    xtype       : 'textfield',
                    name        : 'password',
                    inputType   : 'password',
                    fieldLabel  : t('Hasło')
                },
                {
                    xtype       : 'textfield',
                    name        : 'confirm',
                    inputType   : 'password',
                    fieldLabel  : t('Potwierdzenie')
                },
                {
                    xtype       : 'fileuploadfield',
                    name        : 'filedata1',
                    id          : 'filedata1',
                    emptyText   : t('Wybierz plik do przetworzenia...'),
                    fieldLabel  : t('Plik'),
                    buttonText  : t('Przeglądaj')
                },
                {
                    xtype       : 'fieldset',
                    title       : t('Awatar'),
                    defaults    : {
                        anchor : '100%'
                    },
                    items       : [
                        {
                            xtype       : 'image',
                            anchor      : '20%',
                            src         : 'https://avatars3.githubusercontent.com/u/4108080?s=460'
                        }
                    ]
                },
                {
                    xtype       : 'fieldset',
                    title       : t('Telefon(y)'),
                    defaults    : {
                        anchor : '100%'
                    },
                    items       : [
                        {
                            xtype   : 'grid-phone',
                            flex    : 1,
                            border  : false,
                            name    : 'trade',
                            layout  : 'fit',
                            height  : '100',
                            forceFit: true
                        }
                    ]
                }
            ],
            buttons : [
                {
                    xtype   : 'button',
                    text    : t('Wyślij'),
                    handler : function (me) {
                        var form = me.up('window').down('form');

                        if (form.getForm().isValid()) {
                            form.getForm().submit();
                        }
                    }
                }
            ]
        }
    ],
    listeners: {
        show    : function (me) {
            me.down('[name=username]').setValue(Application.getUser().get('username'));
            me.down('[name=email]').setValue(Application.getUser().get('email'));
        }
    }
});
