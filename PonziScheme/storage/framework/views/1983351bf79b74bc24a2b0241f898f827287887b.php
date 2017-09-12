<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<?php echo $__env->make('Partials._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body >

    <div class="content">
        <?php echo $__env->make('Partials._navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('content-half'); ?>
    </div>
    <?php echo $__env->yieldContent('body'); ?>
    <?php echo $__env->make('Partials._subfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Partials._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
    <script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/fn.codeliter.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.mmenu.js')); ?>"></script>
    <script type="text/javascript">
            //	The menu on the left
        $(function () {
            $('nav#menu-left').mmenu();
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</html>