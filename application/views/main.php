<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en" ng-app="RailApp">
<head>
    <title>Rail on the Road - AngularJS ver.</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('libs/bootstrap/dist/css/bootstrap.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('css/paper.css'); ?>"/>
</head>
<body>
<div class="container">
    <div id="div-header">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">Rail on the Road</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse <?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>"
                     id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>">
                            <a href="<?php echo base_url(); ?>member">Member</a>
                        </li>
                        <li class="<?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>">
                            <a href="<?php echo base_url(); ?>bogies">Bogies</a>
                        </li>
                        <li class="<?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>">
                            <a href="<?php echo base_url(); ?>upload">Upload</a>
                        </li>
                        <li class="dropdown <?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (!$this->aauth->is_loggedin()) {
                            echo "<li><a href='" . base_url() . "auth/signin'>Log In</a></li>";
                            echo "<li><a href='" . base_url() . "auth/signup'>Sign Up</a></li>";
                        } else {
                            echo "<li><a>Welcome " . $this->aauth->get_user()->name . "</a></li>";
                        }
                        ?>
                        <li class="dropdown <?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() ?>auth/profile">Edit Profile</a></li>
                                <li><a href="#">Messages</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url() ?>auth/signout">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <header class="sb-page-header">
            <?php
            if (!$this->aauth->is_loggedin() && $this->uri->segment(1) != 'auth' && $this->uri->segment(2) != 'signin')         //check authentication
                redirect('auth/signin');
            ?>
        </header>
    </div>

    <div id="div-viewer" ng-controller="BogieController as b">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Name (th)</th>
                    <th>Name (en)</th>
                    <th>Short Name (th)</th>
                    <th>Short Name (en)</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr ng-repeat="detail in b.bogies | orderBy:ID">
                    <td><span>{{detail.ID}}</span></td>
                    <td>{{detail.BOGIE_NAME_TH}}</td>
                    <td>{{detail.BOGIE_NAME_EN}}</td>
                    <td>{{detail.BOGIE_SHORT_NAME_TH}}</td>
                    <td>{{detail.BOGIE_SHORT_NAME_EN}}</td>
                    <td>
                        <button class="btn btn-primary" ng-click="addBogie(detail)" title="Add"><span
                                class="glyphicon glyphicon-inbox"></span></button>
                    </td>
                    <td>
                        <button class="btn btn-warning" ng-click="editBogie(detail)" title="Edit"><span
                                class="glyphicon glyphicon-edit"></span></button>
                    </td>
                    <td>
                        <button class="btn btn-danger" ng-click="deleteBogie(detail)" title="Delete"><span
                                class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url('libs/jquery/dist/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular/angular.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-route/angular-route.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('libs/angular-resource/angular-resource.min.js'); ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('js/script.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/app.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/services.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/BogieController.js'); ?>"></script>
</body>
</html>