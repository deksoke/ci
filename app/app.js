/**
 * Created by Taywan_ka on 25/02/2016.
 */
var app = angular.module('RailApp', ['ngRoute', 'ngResource', 'ui.router']);

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
app.config(function ($routeProvider, $urlRouterProvider, $stateProvider) {
    //$httpProvider.interceptors.push('httpRequestInterceptor');

    $routeProvider.
    when('/', {
        templateUrl: 'partials/bogies.html',
        controller: 'BogieController'
    }).
    when('/bogies', {
        templateUrl: 'partials/bogies.html',
        controller: 'BogieController'
    }).
    when('/bogies/new', {
        templateUrl: 'partials/bogie-add.html',
        controller: 'BogieController'
    }).
    when('/bogies/:id/edit', {
        templateUrl: 'partials/bogie-edit.html',
        controller: 'BogieController'
    }).
    when('/bogies/:id/view', {
        templateUrl: 'partials/bogie-view.html',
        controller: 'BogieController'
    }).
    otherwise({
        redirectTo: '/'
    });

});
