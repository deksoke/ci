<!DOCTYPE html>
<html lang="en" ng-app="RailApp">
<head>
    <title>Rail on the Road</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('libs/bootstrap/dist/css/bootstrap.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('css/paper.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('libs/ladda/dist/ladda-themeless.min.css'); ?>"/>
</head>
<body>
<div class="container">
    <div>
        <div ng-include src="'partials/_nav.html'"></div>
    </div>
    <div ng-view></div>

    <script type="text/javascript" src="<?php echo base_url('libs/jquery/dist/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular/angular.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-route/angular-route.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-resource/angular-resource.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-ui-router/release/angular-ui-router.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('libs/spin.js/spin.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-spinner/angular-spinner.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/ladda/dist/ladda.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-ladda/dist/angular-ladda.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-strap/dist/angular-strap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-strap/dist/angular-strap.tpl.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/ngInfiniteScroll/build/ng-infinite-scroll.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-auto-validate/dist/jcs-auto-validate.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/script.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('app/app.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('app/services.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('app/directives.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('app/BogieController.js'); ?>"></script>
</body>
</html>