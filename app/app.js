/**
 * Created by Taywan_ka on 25/02/2016.
 */
var app = angular.module('RailApp', [
    'ngRoute', 
    'ngResource',
    'ui.router',
    'mgcrea.ngStrap',
    'infinite-scroll',
    'angularSpinner',
    'angular-ladda',
    'jcs-autoValidate',
    'ngAnimate',
    'ngToast',
    'ngSanitize'
    ]);

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

app.config(function ($stateProvider, $urlRouterProvider, $locationProvider, $httpProvider, $resourceProvider, laddaProvider, $datepickerProvider, ngToastProvider) {

    $httpProvider.defaults.headers.common['Authorization'] = 'Token 20002cd74d5ce124ae219e739e18956614aab490';
    $resourceProvider.defaults.stripTrailingSlashed = false;
    laddaProvider.setOption({
        style: 'expend-right'
    });
    angular.extend($datepickerProvider.defaults, {
        dateFormat: 'd/M/yyyy',
        autoclose: true
    });
    $locationProvider.html5Mode({
        enabled: false,
        requireBase: true
    });

    //http://tamerayd.in/ngToast/#api
    ngToastProvider.configure({
        verticalPosition: 'bottom', //'top' or 'bottom'
        horizontalPosition: 'right', //'right' or 'left'
        maxNumber: 0 //Maximum number of toast messages to display. (0 = no limit) (number)
    });


    $stateProvider
        .state('home', {
            url: "/home",
            views: {
                'main': {
                    templateUrl: 'app/home/templates/index.html',
                    controller: 'HomeController'
                }
            }
        })
        .state('railtypes', {
            url: "/railtypes",
            views: {
                'main': {
                    templateUrl: 'app/railtype/templates/list.html',
                    controller: 'RailTypeListController'
                }
            }
        })
        .state('railtypes.create', {
            url: "/create",
            views: {
                'main': {
                    templateUrl: 'app/railtype/templates/_edit.html',
                    controller: 'RailTypeCreateController'
                }
            }
        })
        .state('railtypes.edit', {
            url: "/edit/:id",
            views: {
                'main': {
                    templateUrl: 'app/railtype/templates/_edit.html',
                    controller: 'RailTypeDetailController'
                }
            }
        })
        .state('bogies', {
            url: "/bogies",
            views: {
                'main': {
                    templateUrl: 'app/bogie/templates/list.html',
                    controller: 'BogieListController'
                },
                'search': {
                    templateUrl: 'app/bogie/templates/_searchform.html',
                    controller: 'BogieListController'
                }
            }
        })
        .state('bogies.create', {
            url: "/create",
            views: {
                'main': {
                    templateUrl: 'app/bogie/templates/_edit.html',
                    controller: 'BogieCreateController'
                }
            }
        })
        .state('bogies.edit', {
            url: "/edit/:id",
            views: {
                'main': {
                    templateUrl: 'app/bogie/templates/_edit.html',
                    controller: 'BogieDetailController'
                }
            }
        })
        ;

    $urlRouterProvider.otherwise('/home');
});