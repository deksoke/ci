/**
 * Created by Taywan_ka on 25/02/2016.
 */
app.controller('BogieController', function ($scope, BogieService) {

    var bg = this;
    bg.title = "Bogie";
    bg.bogies = [];

    getBogies();

    function getBogies() {
        BogieService.GetData()
            .success(function (data) {
                bg.bogies = data;
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
            });
    }

    $scope.addBogie = function (bogie){
        delete bogie.ID;
        BogieService.Insert(bogie)
            .success(function () {
                getBogies();
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
            });
    };

    $scope.editBogie = function (bogie){
        bogie.BOGIE_NAME_TH = "thailand only";
        BogieService.Update(bogie)
            .success(function () {
                getBogies();
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
            });
    };

    $scope.deleteBogie = function(bogie){
        BogieService.Delete(bogie)
            .success(function () {
                getBogies();
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
                console.log(error);
            });
    };

});
