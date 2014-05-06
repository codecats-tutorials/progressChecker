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
                    name        : 'user[username]',
                    selector    : 'user-username',
                    fieldLabel  : t('Nazwa')
                },
                {
                    xtype       : 'textfield',
                    name        : 'user[email]',
                    selector    : 'user-email',
                    fieldLabel  : t('Email'),
                    vtype       : 'email'
                },
                {
                    xtype       : 'textfield',
                    name        : 'user[password][password]',
                    inputType   : 'password',
                    fieldLabel  : t('Hasło')
                },
                {
                    xtype       : 'textfield',
                    name        : 'user[password][confirm]',
                    inputType   : 'password',
                    fieldLabel  : t('Potwierdzenie')
                },
                {
                    xtype       : 'fileuploadfield',
                    name        : 'user[avatar][file]',
                    id          : 'filedata1',
                    emptyText   : t('Wybierz plik do przetworzenia...'),
                    fieldLabel  : t('Plik'),
                    buttonText  : t('Przeglądaj')
                },
                {
                    xtype       : 'fieldset',
                    title       : t('Awatar'),
                    name        : 'avatar',
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
                            form.getForm().submit({
                                success: function (f, action) {
                                    form.down('[name=avatar]').down('image').setSrc(Application.getUser().get('avatar') + '?' + Math.random());
                                }
                            });
                        }
                    }
                }
            ]
        }
    ],
    listeners: {
        show    : function (me) {
            me.down('[selector=user-username]').setValue(Application.getUser().get('username'));
            me.down('[selector=user-email]').setValue(Application.getUser().get('email'));
            me.down('[name=avatar]').down('image').setSrc(Application.getUser().get('avatar') + '?' + Math.random());
        }
    }
});
