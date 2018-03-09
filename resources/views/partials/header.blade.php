<nav class="uk-navbar-container" uk-navbar style="background-color: #3D4049;">
            <div class="uk-navbar-left">
                <span uk-icon="icon: menu; ratio: 4"  uk-toggle="target: #offcanvas-nav"></span>  
            </div>
            <a href="{{ route('layouts.main') }}" class="uk-navbar-item uk-logo">Welcome to Bindle</a>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    
                    <li>
                        <a href="#">| Options and Settings |</a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-active"><i class="fa fa-user-circle" aria-hidden="true">  Welcome {{ $name }}</i></li>
                                <li class="uk-active"><a href="#"><i class="fa fa-wrench" aria-hidden="true">  User Settings</i></a></li>
                                <li class="uk-active"><a href="#"><i class="fa fa-bell" aria-hidden="true">  Alerts</i></a></li>
                                <li class="uk-active"><a href="#"><i class="fa fa-envelope" aria-hidden="true">  Emails</i></a></li>                                
                                <li class="uk-nav-divider"></li>
                                <li class="uk-active"><a href="{{ action('loginController@logOut') }}"><i class="fa fa-lock" aria-hidden="true">  Logout</i></a></li>
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
                    <h5>Hello {{ $name }}</h5>
                    <ul class="uk-nav uk-nav-default">
                        <li class="uk-active"><a href="{{ route('layouts.main') }}">Home</a></li>                        
                        <li class="uk-nav-header">Support</li>
                        <li><a href="{{ route('layouts.customermenu') }}"><span class="uk-margin-small-right"></span> Customers</a></li>
                        <li><a href=""><span class="uk-margin-small-right"></span> Wholesalers and dealer groups</a></li>
                        <li><a href="{{ route('layouts.issues') }}"><span class="uk-margin-small-right"></span> Issues</a></li>
                        <li><a href="{{ route('layouts.reports') }}"><span class="uk-margin-small-right"></span> Reports</a></li>
                        <li><a href="{{ route('layouts.knowledgebase') }}"><span class="uk-margin-small-right"></span> Knowledge base</a></li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-nav-header">Sales</li>
                        <li><a href="{{ route('layouts.prospects') }}"><span class="uk-margin-small-right"></span> Prospects</a></li>
                        <li><a href="{{ route('layouts.salesnotes') }}"><span class="uk-margin-small-right"></span> Notes</a></li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-nav-header">Accounts</li>
                        <li><a href="{{ route('layouts.accounts') }}"><span class="uk-margin-small-right"></span> Reports</a></li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-nav-header">Development</li>
                        <li><a href="{{ route('layouts.pulseofficeversiondata') }}"><span class="uk-margin-small-right"></span> Pulse Office Version Data</a></li>
                        <li><a href="{{ route('layouts.pulsestore') }}"><span class="uk-margin-small-right"></span> Pulse Store revisions</a></li>
                        <li><a href="{{ route('layouts.pulsecloud') }}"><span class="uk-margin-small-right"></span> Pulse Cloud revisions</a></li>
                        <li><a href="{{ route('layouts.wishlist') }}"><span class="uk-margin-small-right"></span> Wish list</a></li>
                        <li class="uk-nav-divider"></li>
                        <li class="uk-nav-header">Site Admin</li>
                        <li><a href="{{ route('layouts.admin') }}"><span class="uk-margin-small-right">Site Admin</span></a></li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="">Holiday Calendar</a></li>
                    </ul>
                </div>
            </div>
        </div>