/**
 * Created by Taywan_ka on 25/02/2016.
 */
app.controller('BogieDetailController', ['$scope', '$stateParams', '$state', 'BogieService', function ($scope, $stateParams, $state, BogieService) {
    $scope.mode = "Edit";

    $scope.Bogies = BogieService;
    var id = $stateParams.id;
    $scope.Bogies.selectedBogie = $scope.Bogies.getBogie(id);
    console.log($scope.Bogies.selectedBogie);

    $scope.save = function () {
        $scope.Bogies.updateBogie($scope.Bogies.selectedBogie).then(function () {
            $state.go("bogies");
        });
    };

    $scope.remove = function (bogieItem) {
        $scope.Bogies.removeBogie(bogieItem).then(function () {
            $state.go("bogies");
        });
    };
}]);

app.controller('BogieCreateController', ['$scope', '$state', 'BogieService', function ($scope, $state, BogieService) {
    $scope.mode = "Create";

    $scope.Bogies = BogieService;
    $scope.Bogies.selectedBogie = {};

    $scope.save = function () {
        console.log($scope.Bogies.selectedBogie);
        BogieService.createBogie($scope.Bogies.selectedBogie).then(function () {
            $state.go("bogies");
        });
    };
}]);

app.controller('BogieListController', ['$scope', '$modal', 'BogieService', function ($scope, $modal, BogieService) {
    $scope.search = "";
    $scope.order = "ID";
    $scope.Bogies = BogieService;
    $scope.loadMore = function () {
        $scope.Bogies.loadMore();
    };

    $scope.view = function(bogieItem){
        alert('click view');
    }
}]);