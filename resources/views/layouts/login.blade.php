<!doctype html>
<html lang="{{ app()->getLocale() }}" style="height:100%">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bindle</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://use.fontawesome.com/dbbbc74c74.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.28/css/uikit.min.css" />        
        

        
        <script src="{{ URL::asset('js/custom.js') }}" type="text/javascript"></script>

        <!-- jQuery is required -->
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/af-2.2.0/b-1.4.0/b-print-1.4.0/cr-1.3.3/r-2.1.1/datatables.min.css"/>

        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/af-2.2.0/b-1.4.0/b-print-1.4.0/cr-1.3.3/r-2.1.1/datatables.min.js"></script>
        <!-- UIkit JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.28/js/uikit.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.28/js/uikit-icons.min.js"></script>
        <body style="background: url(../images/gotham.jpg) center center; height:100%;">    

<div class="uk-container-center">    
    <div class="uk-child-width-expand@s uk-text-center" uk-grid>
    <div>
        <div class="uk-card uk-card-default uk-card-body" hidden></div>
    </div>
        <div id="login" style="background-color: transparent">
        <div class="uk-card uk-card-default uk-card-body" >
            <h1>Welcome to Bindle</h1>
            <span uk-icon="icon: unlock; ratio: 4"></span>
            <h2>Please enter your Email address and password. </h2>
                <form class="uk-panel uk-panel-box uk-form" action="{{action('loginController@logUserIn')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="uk-form-row">
                        <input class="uk-width-1-1 uk-form-large" type="text" placeholder="Email" name="email">
                    </div>
                    <div class="uk-form-row">
                        <input class="uk-width-1-1 uk-form-large" type="password" placeholder="Password" name="password">
                    </div>
                    <div class="uk-form-row">
                        <button class="uk-width-1-1 uk-button uk-button-primary uk-button-large">Login</button>
                    </div>
                    <div class="uk-form-row uk-text-small">                        
                        <a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a>
                    </div>
                </form>
                @if(isset($message))
                {!! $message !!}
                @endif
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-default uk-card-body" hidden=""></div>
    </div>
</div>
</div>