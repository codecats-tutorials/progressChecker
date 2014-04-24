Ext.define('Pc.window.node_.Profile', {
    extend: 'Pc.window.Node',
    title: t('Twoje konto'),
    items: [
        {
            xtype   : 'form',
            width   : '100%',
            layout  : {
                anchor : '50%'
            },
            url     : url('user/details'),
            items   : [
                {
                    xtype       : 'textfield',
                    fieldLabel  : t('Nazwa')
                },
                {
                    xtype       : 'textfield',
                    fieldLabel  : t('Email'),
                    vtype       : 'email'
                },
                {
                    xtype       : 'textfield',
                    inputType   : 'password',
                    fieldLabel  : t('Hasło')
                },
                {
                    xtype       : 'textfield',
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
                    xtype       : 'image',
                    fieldLabel  : 'dd',
                    src         : 'http://www.sencha.com/img/20110215-feat-html5.png'
                }
            ],
            buttons : [
                {
                    xtype   : 'button',
                    text    : t('Wyślij'),
                    handler : function (me) {

                    }
                }
            ]
        }
    ],
    listeners: {
        show    : function (me) {
            console.log('dupa')
        }
    }
});
