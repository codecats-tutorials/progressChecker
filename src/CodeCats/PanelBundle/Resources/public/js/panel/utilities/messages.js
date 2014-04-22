/**
 * Created by t on 07.01.14.
 */
Ext.define('uniCrm.Messages', {
    statics     : {
        loadMask  : function () {
            return t('Proszę czekać...');
        },
        confirmAction		: function(callback, msg) {
            msg = msg || {};
            if (typeof(msg['title']) === 'undefined') msg['title'] = t('Czy jesteś pewien');
            if (typeof(msg['content']) === 'undefined')
                msg['content'] = t('Operacja jest nieodwracalna, czy kontynuować?');

            Ext.Msg.confirm(
                msg.title,
                msg.content, function(msgBtn) {
                    if (msgBtn == 'yes') {
                        callback();
                    }
            });
        }
    }
});