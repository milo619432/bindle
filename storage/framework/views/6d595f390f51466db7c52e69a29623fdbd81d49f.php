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
        

        
        <script src="<?php echo e(URL::asset('js/custom.js')); ?>" type="text/javascript"></script>

        <!-- jQuery is required -->
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/af-2.2.0/b-1.4.0/b-print-1.4.0/cr-1.3.3/r-2.1.1/datatables.min.css"/>

        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/af-2.2.0/b-1.4.0/b-print-1.4.0/cr-1.3.3/r-2.1.1/datatables.min.js"></script>
        <!-- UIkit JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.28/js/uikit.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.28/js/uikit-icons.min.js"></script>
        <body style="background-color: #F4F0EC; height: 100%">
        <?php if(1 !== 1): ?>
        <?php echo $__env->make('partials.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
        <?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <br>
        <?php echo $__env->make('partials.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>


    </body>
</html>
