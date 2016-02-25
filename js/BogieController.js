/**
 * Created by Taywan_ka on 25/02/2016.
 */
app.controller('BogieController', function ($scope, BogieService) {

    var bg = this;
    bg.title = "Bogie";
    bg.bogies = [];

    $scope.getBogieLists = function () {
        bg.bogies = [];
        BogieService.GetData()
            .success(function (data) {
                bg.bogies = data;
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
            });
    };

    $scope.addBogie = function () {
        if (bg.bogies.length == 0)
            return;

        var rnd = getRandomIntInclusive(0, bg.bogies.length - 1);
        var bogie = bg.bogies[rnd];

        BogieService.Insert(bogie)
            .success(function (data) {
                bg.bogies.push(data.entity);
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
            });
    };

    $scope.editBogie = function (bogie) {
        BogieService.Update(bogie)
            .success(function (data) {
                bogie.UPDATE_DATE = data.entity.UPDATE_DATE;
                bogie.UPDATE_USER = data.entity.UPDATE_USER;
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
            });
    };

    $scope.deleteBogie = function (bogie) {
        BogieService.Delete(bogie)
            .success(function () {
                bg.bogies.splice(bg.bogies.indexOf(bogie), 1);
            })
            .error(function (error) {
                $scope.status = 'Unable to load data: ' + error.message;
                console.log(error);
            });
    };

});
