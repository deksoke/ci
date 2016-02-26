/**
 * Created by Taywan_ka on 25/02/2016.
 */
app.controller('BogieController', function ($scope, $state, BogieService) {
    var self = this;

    $scope.bogie = {};
    $scope.bogies = [];

    $scope.getBogieLists = function () {
        $scope.bogies = [];
        BogieService.GetData()
            .success(function (data) {
                $scope.bogies = data;
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
            });
    };

    $scope.getBogieById = function(id){
        if ($scope.bogies.length == 0)
            return null;
        var result;
        for(var i = 0; i < $scope.bogies.length -1; i++){
            if ($scope.bogies[i].ID == id){
                result = $scope.bogies[i];
                break;
            }
        }
        return result;
    };

    $scope.addBogie = function () {
        $scope.bogie = {};
    };

    $scope.insertBogie = function () {
        BogieService.Insert($scope.bogie)
            .success(function (data) {
                $scope.bogies.push(data.entity);
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
            });
    };

    $scope.editBogie = function (id) {
        $scope.bogie = self.getBogieById(id);
        console.log('edit:' + id);
    };

    $scope.updateBogie = function () {
        BogieService.Update($scope.bogie)
            .success(function (data) {
                $scope.bogie.UPDATE_DATE = data.entity.UPDATE_DATE;
                $scope.bogie.UPDATE_USER = data.entity.UPDATE_USER;
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
            });
    };

    $scope.deleteBogie = function (bogieObj) {
        BogieService.Delete(bogieObj)
            .success(function () {
                $scope.bogies.splice($scope.bogies.indexOf(bogieObj), 1);
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
                console.log(error);
            });
    };

});
