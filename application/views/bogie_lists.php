<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>REST Server Tests</title>
</head>
<body ng-app="myApp">
    <ol ng-controller="MainController">
        <li ng-repeat="item in items">
            {{item.name}}
        </li>
    </ol>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-rc.2/angular.min.js"></script>
    <script>
        var app = angular.module('myApp', []);

        app.controller('MainController', function($scope){
            $scope.items = ["ttt", "xxx", "fwew"];
        });
    </script>
</body>
</html>
