/**
 * Created by Kaibutsu on 28/2/2559.
 */
app.filter('defaultImage', function () {
    return function (input, param) {
        if (!input) {
            return param
        }
        return input;
    }
});