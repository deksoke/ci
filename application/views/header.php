<!doctype>
<html>
<head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>libs/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/paper.css" />
    <title><?php echo getHeaderTitle(); ?></title>
</head>
<body>
<div class="container">
    <div id="div-header">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">Dev Test</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse <?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>">
                            <a href="<?php echo base_url(); ?>member">Member</a>
                        </li>
                        <li class="<?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>">
                            <a href="<?php echo base_url(); ?>upload">Upload</a>
                        </li>
                        <li class="dropdown <?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
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
                            if(!$this->aauth->is_loggedin()) {
                                echo "<li><a href='" . base_url() . "auth/signin'>Log In</a></li>";
                                echo "<li><a href='" . base_url() . "auth/signup'>Sign Up</a></li>";
                            }else{
                                echo "<li><a>Welcome ".$this->aauth->get_user()->name."</a></li>";
                            }
                        ?>
                        <li class="dropdown <?php echo !$this->aauth->is_loggedin() ? 'hide' : ''; ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
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

                //check authentication

                if(!$this->aauth->is_loggedin() && $this->uri->segment(1) != 'auth' && $this->uri->segment(2)!='signin')
                {
                    redirect('auth/signin');
                }

            ?>
        </header>
    </div>
    <div id="div-content">