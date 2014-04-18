(function () {
    CodeCats.translation = {
        locale: 'en',
        t: function () {

        }
    };

    var user = JSON.parse(document.querySelector('#user').innerHTML);
    CodeCats.translation.locale = user.locale;
}) ();