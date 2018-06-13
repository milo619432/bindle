<nav class="uk-navbar-container" uk-navbar style="background-color: #3D4049;">
            <div class="uk-navbar-left">
                <span uk-icon="icon: menu; ratio: 4"  uk-toggle="target: #offcanvas-nav"></span>  
            </div>
            <a href="<?php echo e(route('layouts.main')); ?>" class="uk-navbar-item uk-logo">Welcome to Bindle</a>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    
                    <li>
                        <a href="#">| Options and Settings |</a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><i class="fa fa-user-circle" aria-hidden="true">  Welcome <?php echo e($name); ?></i></li>
                                <li class="uk-active"><a href="#"><i class="fa fa-wrench" aria-hidden="true">  User Settings</i></a></li>
                                <li class="uk-active"><a href="#"><i class="fa fa-bell" aria-hidden="true">  Alerts</i></a></li>
                                <li class="uk-active"><a href="#"><i class="fa fa-envelope" aria-hidden="true">  Emails</i></a></li>                                
                                <li class="uk-nav-divider"></li>
                                <li class="uk-active"><a href="<?php echo e(action('loginController@logOut')); ?>"><i class="fa fa-lock" aria-hidden="true">  Logout</i></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="uk-offcanvas-content">
            <div id="offcanvas-nav" uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar">
                    <h1>Bindle</h1>
                    <h5>Hello <?php echo e($name); ?></h5>
                    <ul class="uk-nav uk-nav-default">
                        <li class="uk-active"><a href="<?php echo e(route('layouts.main')); ?>">Home</a></li>                        
                        <li class="uk-nav-header">Support</li>
                        <li><a href="<?php echo e(route('layouts.customermenu')); ?>"><span class="uk-margin-small-right"></span> Customers</a></li>                        
                        <li><a href="<?php echo e(route('layouts.issues')); ?>"><span class="uk-margin-small-right"></span> Issues</a></li>                        
                        <li class="uk-nav-divider"></li>                        
                        <li class="uk-nav-header">Development</li>                                                
                        <!--<li><a href="<?php echo e(route('layouts.wishlist')); ?>"><span class="uk-margin-small-right"></span> Wish list/Bug list</a></li>-->
                        <li class="uk-nav-divider"></li>
                        <li class="uk-nav-header">Site Admin</li>
                        <li><a href="<?php echo e(route('layouts.admin')); ?>"><span class="uk-margin-small-right">Site Admin</span></a></li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="">Holiday Calendar</a></li>
                    </ul>
                </div>
            </div>
        </div>