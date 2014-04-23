Ext.define('Pc.viewport.Header', {
    extend      : 'Ext.Toolbar',
    alias       : 'widget.pc-header',
    region      : 'north',
    border      : 'vbox',
    title       : 'abc',
    items       : [
        {
            html : 'aaa'
        },
        '->',
        {
            xtype   : 'button',
            name    : 'user',
            text    : t('Użytkownik: '),
            menu    : {
                xtype       : 'menu',
                floating    : true,
                items       : [
                    {
                        text    : t('Twój profil'),
                        handler : function (me) {
                            Ext.create('Pc.window.node_.Profile').show();
                        }
                    },
                    {
                        text    : t('Konfiguracja'),
                        handler : function (me) {
                            Ext.create('Pc.window.node_.Configuration').show();
                        }
                    },
                    {
                        text    : t('Wyloguj się'),
                        handler : function (me) {
                            document.location = Application.getUser().get('logoutUrl');
                        }
                    }
                ]
            }
        }
    ],
    listeners   : {
        afterrender : function(me) {
            bug.d({m:me})
        }
    }
});