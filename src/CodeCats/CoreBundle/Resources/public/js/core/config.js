var CodeCats = CodeCats || {};
var I18n = I18n || {};

var URL_DEV  = '/app_dev.php/panel';
var URL_PROD = '/app.php/panel';

var base_url = URL_DEV;

function url(dest, base) {
    if (typeof(base) === 'undefined') base = base_url;
    return (base_url + '/' + dest);
}
//window.onbeforeunload = function(){
//    return t('Are you sure you want to leave?');
//};
