/**
 * Created by Taywan_ka on 25/02/2016.
 */
var app = angular.module('RailApp', ['ngRoute', 'ngResource']);

app.factory('httpRequestInterceptor', function () {
    return {
        request: function (config) {

            //config.headers['Authorization'] = 'Basic d2VudHdvcnRobWFuOkNoYW5nZV9tZQ==';
            //config.headers['Accept'] = 'application/json;odata=verbose';
            config.headers['Content-Type'] = 'application/json;charset=utf-8';
            config.headers['Access-Control-Allow-Origin'] = '*';
            config.headers['Access-Control-Allow-Methods'] = 'GET, POST, OPTIONS, PUT, DELETE';
            config.headers['Access-Control-Allow-Headers'] = 'X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method';

            return config;
        }
    };
});

//config
app.config(function ($routeProvider) {
    //$httpProvider.interceptors.push('httpRequestInterceptor');

    $routeProvider.
    when('/:xxx', {
        templateUrl: 'country-list.html',
        controller: 'BogieController'
    }).
    when('/:countryName', {
        templateUrl: 'country-detail.html',
        controller: 'CountryDetailController'
    }).
    otherwise({
        redirectTo: '/'
    });
});
