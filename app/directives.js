/**
 * Created by Taywan_ka on 26/02/2016.
 */
app.directive('sharedSpinner', function () {
    return {
        'restrict': 'AE',
        'templateUrl': 'app/templates/shared/_spinner.html',
        'scope': {
            'isLoading': '=',
            'message': '@'
        }
    }
});