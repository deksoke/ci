/**
 * Created by Taywan_ka on 25/02/2016.
 */
app.controller('RailtypeDetailController', ['$scope', '$stateParams', '$state', 'RailtypeService', function ($scope, $stateParams, $state, RailtypeService) {
    $scope.mode = "Edit";

    $scope.RailTypes = RailtypeService;
    var id = $stateParams.id;
    $scope.RailTypes.selectedRailtype = $scope.RailTypes.getBogie(id);
    console.log($scope.RailTypes.selectedRailtype);

    $scope.save = function () {
        $scope.RailTypes.updateRailType($scope.RailTypes.selectedRailtype).then(function () {
            $state.go("railtypes");
        });
    };

    $scope.remove = function (bogieItem) {
        $scope.RailTypes.removeRailType(bogieItem).then(function () {
            $state.go("railtypes");
        });
    };
}]);

app.controller('RailTypeCreateController', ['$scope', '$state', 'RailtypeService', function ($scope, $state, RailtypeService) {
    $scope.mode = "Create";

    $scope.RailTypes = RailtypeService;
    $scope.RailTypes.selectedRailtype = {};

    $scope.save = function () {
        console.log($scope.RailTypes.selectedRailtype);
        RailtypeService.createRailType($scope.RailTypes.selectedRailtype).then(function () {
            $state.go("railtypes");
        });
    };
}]);

app.controller('RailTypeListController', ['$scope', '$modal', 'RailtypeService', function ($scope, $modal, RailtypeService) {
    $scope.search = "";
    $scope.order = "ID";
    $scope.RailTypes = RailtypeService;
    $scope.loadMore = function () {
        $scope.RailTypes.loadMore();
    };
}]);