/**
 * Created by t on 07.01.14.
 */
Ext.define('uniCrm.Utilities', {
    statics     : {
        isArray     : function (obj) {
            if( Object.prototype.toString.call(obj) === '[object Array]' ) {
                return true;
            }
            
            return false;
        },
        underscore2Camelcase : function (text) {
            return text.replace(/_(.{1})/g, function(a, l) { return l.toUpperCase(); });
        },
        underscore2dash : function (text) {
            return text.replace(/_/g, '-');
        },
        dash2underscore : function (text) {
            return text.replace(/-/g, '_');
        },
        camelcase2dash  : function (text) {
            text = uniCrm.Utilities.lcfirst(text);
            text = text.replace(/([A-Z])/g, ' $1');
            text = text.toLowerCase();

            return text.split(' ').join('-');
        },
        lcfirst         : function (text) {
            return text.charAt(0).toLowerCase() + text.substr(1);
        },
        ucfirst         : function (text) {
            return text.charAt(0).toUpperCase() + text.substr(1);
        },
        storeStringify  : function (store) {
            var container = [];
            if (typeof(store.each) === 'function') {
                store.each(function(node) {
                    var obj = {};

                    for (var i in node.data) {
                        obj[i] = node.data[i];
                    }
                    container.push(obj);
                });
            } else {
                var obj = {};
                for (var i in store) {
                    
                    obj[i] = {};
                    
                    for (var it in store[i].data) {
                        obj[i][it] = store[i].data[it];
                    }
                    container.push(obj[i]);
                }
            }

            return JSON.stringify(container);
        },
        isTelProtocolSupported : function () {
            var i = document.createElement('input');
            i.setAttribute('type', 'tel');
            return i.type === 'tel';
        },
        ifNullToStr                : function (txt) {
            if (txt === null) return '';
            
            return txt;
        }
    }
});