/**
 * Created by Taywan_ka on 26/02/2016.
 */
app.directive("bogieFrom", function() {
    return {
        restrict: "E",
        templateUrl: "partials/_bogie_form.html"
    };
});

app.directive("navigaterPanel", function() {
    return {
        restrict: 'E',
        templateUrl: 'partials/_nav.html'
    };
});