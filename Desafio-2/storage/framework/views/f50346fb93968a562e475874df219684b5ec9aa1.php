<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="" />
        <meta name="description" content="" />
        <meta name="keywords" content=""/>
        <meta name="robots" content="index, follow" />


        <title>Desafio-2</title>

        <!-- Fonts -->
        <link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css" />
        <?php echo $__env->yieldContent('assets'); ?>
    </head>
    <body>
  <div class="container">
    <?php echo $__env->yieldContent('content'); ?>
  </div>
  <script src="<?php echo e(asset('js/app.js')); ?>" type="text/js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
  <?php echo $__env->yieldContent('script'); ?>
</body>
</html>

<?php /**PATH C:\laragon\www\Desafio-2\resources\views/layout.blade.php ENDPATH**/ ?>