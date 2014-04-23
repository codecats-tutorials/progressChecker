/**
 * Created by t on 24.12.13.
 *
 * If production mode is on delete this file.
 */
var bug = bug || {
    /*
     * Debuger use:
     * var p = new Person();
     * bug.d({me:p}, false);
     *
     * console.log(widget.me);
     *
     * out:
     * 	[object]
     * 	[object]
     */
    /**
     * store object, if silence is false then show log with this object
     * @param obj
     * @param silence bool
     */
    d 				: function(obj, silence) {
        silence = (typeof(silence) === 'undefined') ? true : (!! silence);

        for(key in obj) {
            if (key != 'd') this[key] = obj[key];
            else throw new Error('Trying eat myself');
            if (silence === false) console.log(key, obj[key]);
        }
    },
    l 				: console.log,
    /**
     * alians for d but default show stored object in log
     *
     * @param obj
     * @param noise bool
     */
    dl              : function (obj, noise) {
        noise = (typeof(silence) === 'undefined') ? true : (!! noise);
        this.d(obj, ! noise);
    },
    
    req             : function (params) {
        var url = ''
        if (typeof(params) === 'string') {
            var url = params
            params = undefined
        }
     
        params = params ||{
                url 		: url,
                success 	: function (response) {
                    bug.dl({res:response})
                }
        }
        Ext.Ajax.request(params)
    }
};
//useful:
/*
Ext.Ajax.request({
        url 		: 'access/getuser',
        success 	: function (response) {
    }
});
 */
