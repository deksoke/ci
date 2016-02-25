/**
 * Created by Taywan_ka on 25/02/2016.
 */
app.factory('BogieService', function ($http) {

    var urlBase = 'api/bogies';
    var dataFactory = {};

    dataFactory.GetData = function () {
        return $http.get(urlBase);
    };
    dataFactory.GetDataById = function (id) {
        return $http.get(urlBase + '/' + id);
    };
    dataFactory.Insert = function (entity) {
        return $http.post(urlBase, entity);
    };
    dataFactory.Update = function (entity) {
        return $http.put(urlBase + '/' + entity.ID, entity);
    };
    dataFactory.Delete = function (entity) {
        return $http.delete(urlBase + '/' + entity.ID);
    };

    return dataFactory;
});


app.factory('RailTypeService', function ($http) {

    var urlBase = 'api/railtypes';
    var dataFactory = {};

    dataFactory.GetData = function () {
        return $http.get(urlBase);
    };
    dataFactory.GetDataById = function (id) {
        return $http.get(urlBase + '/' + id);
    };
    dataFactory.Insert = function (entity) {
        return $http.post(urlBase, entity);
    };
    dataFactory.Update = function (entity) {
        return $http.put(urlBase + '/' + entity.ID, entity);
    };
    dataFactory.Delete = function (entity) {
        return $http.delete(urlBase + '/' + entity.ID);
    };

    return dataFactory;
});
