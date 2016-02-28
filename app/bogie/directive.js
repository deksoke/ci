/**
 * Created by Taywan_ka on 26/02/2016.
 */
app.directive('bogieSpinner', function () {
    return {
        'restrict': 'AE',
        'templateUrl': 'app/bogie/templates/_spinner.html',
        'scope': {
            'isLoading': '=',
            'message': '@'
        }
    }
});

app.directive('bogieCard', function () {
    return {
        'restrict': 'AE',
        'templateUrl': 'app/bogie/templates/_card.html',
        'scope': {
            'data': '='
        },
        'controller': function ($scope, BogieService) {
            $scope.isDeleting = false;
            $scope.deleteBogie = function () {
                $scope.isDeleting = true;
                BogieService.removeBogie($scope.bogie).then(function () {
                    $scope.isDeleting = false;
                });
            };
        }
    }
});

app.directive('bogieTableSelectItem', function () {
    return {
        'restrict': 'AE',
        'templateUrl': 'app/bogie/templates/table.html',
        'scope': {
            'data': '='
        },
        'controller': function ($scope) {
            if ($scope.isChecked == null)
                $scope.isChecked = false;
            $scope.checkItem = function () {
                $scope.isChecked = !$scope.isChecked;
            };
        }
    }
});