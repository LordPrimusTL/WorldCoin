<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>Invest Now</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="container" style="margin-top:20px;">
        <?php echo $__env->make('Partials._message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <form method="post" action="<?php echo e('/user/invest'); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="form-horizontal">
                <div class="col-md-offset-4 col-md-4">
                    <div class="form-group">
                        <input type="number" min="21" class="form-control input-lg" name="inv_number" id="inv_number" placeholder="Investment Amount" style="border-radius:0!important;"/>
                    </div>
                    <p class="well-sm">
                        Please note that you can only invest $21 and above.
                    </p>
                </div>
                <div class="col-md-offset-4 col-md-4">
                    <div class="form-group">
                        <button class="btn btn-default btn-block input-lg" style="background-color:skyblue;border-radius:0 !important; color: #fff;">Donate</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>