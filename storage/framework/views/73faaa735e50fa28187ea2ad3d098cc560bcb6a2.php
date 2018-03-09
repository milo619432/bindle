<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>" style="height:100%">
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
        <!--bootstrap links -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="<?php echo e(asset('css/custom.css')); ?>" media="all" rel="stylesheet" type="text/css" />

        
        <script src="<?php echo e(URL::asset('js/custom.js')); ?>" type="text/javascript"></script>

        <!-- jQuery is required -->
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/af-2.2.0/b-1.4.0/b-print-1.4.0/cr-1.3.3/r-2.1.1/datatables.min.css"/>

        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/af-2.2.0/b-1.4.0/b-print-1.4.0/cr-1.3.3/r-2.1.1/datatables.min.js"></script>
        <!-- UIkit JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.28/js/uikit.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.28/js/uikit-icons.min.js"></script>
        <body style="background-color: #FAEBD7; height: 100%">
        <?php
            $userLoggedIn = Session::get('loggedIn');     
            $name = session::get('name');
            $email = session::get('email');
            $level = session::get('status');
            if('1' == $userLoggedIn){
        ?>
        <?php echo $__env->make('partials.header', ['name'=>$name, 'email'=>$email], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <br>
        <?php echo $__env->yieldContent('maindash'); ?>
        <?php echo $__env->yieldContent('customertable'); ?>
        <?php echo $__env->yieldContent('issues'); ?>
        <?php echo $__env->yieldContent('reports'); ?>
        <?php echo $__env->yieldContent('knowledgebase'); ?>
        <?php echo $__env->yieldContent('prospects'); ?>
        <?php echo $__env->yieldContent('salesnotes'); ?>
        <?php echo $__env->yieldContent('accounts'); ?>
        <?php echo $__env->yieldContent('pulsedata'); ?>
        <?php echo $__env->yieldContent('pulsestore'); ?>
        <?php echo $__env->yieldContent('pulsecloud'); ?>
        <?php echo $__env->yieldContent('wishlist'); ?>
        <?php
            } else {
                die('<div id=notallowed>
                    <div class="uk-overlay uk-position-center">
                    <h2>Now look what you have done..........</h2><br>
                    <h3>Make sure you have logged in and use the links provided to navigate.</h3>
                    <h4>I wont tell you again. <a href="bindle/public/">Click here to do it properly</a><h4>
                    <button><button>
                    </div>
                    </div>');
            }
            if($level == 'super')
            { ?>
            <?php echo $__env->yieldContent('admin'); ?>    
            <?php             
            } 
            else 
            {?>
                <?php echo $__env->yieldContent('notAllowed'); ?>
            <?php
            }
            
        ?>



    </body>
</html>
