Ext.define('uniCrm.Date', {
    statics     : {
        renderTimestamp : function (timestamp) {
            if ( ! timestamp) return '';
            if (timestamp.length === 10) timestamp += '000';
            
            var date = new Date();
            date.setTime(timestamp);
            
            return date.toISOString().slice(0, 19).replace('T', ' ');;
        },
        datetimeToDate : function (datetime) {
            
            return new Date(Date.parse(datetime).getTime());
        }
    }
});