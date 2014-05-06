Ext.define('Pc.window.node_.Configuration', {
    extend  : 'Pc.window.Node',
    title   : t('Konfiguracja'),
    items   : [
        {
            xtype   : 'tabpanel',
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
                    url         : url('company-email'),
                    items       : [
                        {
                            xtype       : 'textfield',
                            name        : 'emailType[username]',
                            selector    : 'emailType-username',
                            fieldLabel  : t('Nazwa użytkownika')
                        },
                        {
                            xtype       : 'textfield',
                            name        : 'emailType[transferProtocol]',
                            selector    : 'emailType-transferProtocol',
                            fieldLabel  : t('Protokół')
                        },
                        {
                            xtype       : 'numberfield',
                            maxValue    : 9999,
                            minValue    : 0,
                            name        : 'emailType[port]',
                            selector    : 'emailType-port',
                            fieldLabel  : t('Port')
                        },
                        {
                            xtype       : 'textfield',
                            name        : 'emailType[sendFrom]',
                            selector    : 'emailType-sendForm',
                            fieldLabel  : t('Nadawca')
                        },
                        {
                            xtype       : 'textfield',
                            inputType   : 'password',
                            name        : 'emailType[password][password]',
                            selector    : 'emailType-password-password',
                            fieldLabel  : t('Hasło')
                        },
                        {
                            xtype       : 'textfield',
                            inputType   : 'password',
                            name        : 'emailType[password][confirm]',
                            selector    : 'emailType-password-confirm',
                            fieldLabel  : t('Powtórz')
                        }
                    ],
                    buttons: [
                        {
                            xtype: 'button',
                            text: t('Zapisz'),
                            handler: function (me) {
                                var form = me.up('window').down('form');

                                if (form.getForm().isValid()) {
                                    form.getForm().submit({url: form.getForm().url});
                                }
                            }
                        }
                    ]
                }
            ]
        }
    ],
    listeners: {
        show    : function (me) {
            var form = me.down('form');

            Ext.Ajax.request({
                method  : 'GET',
                url     : form.getForm().url,
                success : function (response) {
                    var resp = JSON.parse(response.responseText);

                    form.items.each(function(it) {
                        console.log(it);
                    });
                    if (resp.data !== null) {
                        form.add({
                            xtype       : 'textfield',
                            name        : '_method',
                            value       : 'PUT',
                            hidden      : true
                        });
                        form.getForm().url += '/' + resp.data.id;
                    }
                }
            });
        }
    }
});
