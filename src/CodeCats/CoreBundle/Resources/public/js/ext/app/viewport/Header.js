Ext.define('Pl.viewport.Header', {
    extend      : 'Ext.Toolbar',
    alias       : 'widget.pl-header',
    region      : 'north',
    border      : 'vbox',
    title       : 'abc',
    items       : [
        {
            html        : t('Wyślij e-mail'),
            handler     : function (btn) {
//                Ext.create('Pc.window.node_.SendEmail').show();
            }
        },
        {
            xtype: 'container',
            cls  : 'x-viewport-header-title',
            html : 'ProgressLog 0.0<small>pre-alpha</small>'
        },
        '->',
        {
            xtype   : 'button',
            name    : 'user',
            text    : t('Użytkownik: '),
            iconCls : 'icon-small-fat-cow-script_code',
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
          //  bug.d({m:me})
        }
    }
});