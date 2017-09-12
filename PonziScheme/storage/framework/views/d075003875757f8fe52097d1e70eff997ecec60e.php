<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>Log In</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <!-- start main -->
    <div class="mid_bg">
        <p class="about-title">Account Information</p>
        <div class="wrap">
            <div class="details p-signup">
                <?php echo $__env->make('Partials._message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <form role="form" action="<?php echo e(url('user/signin')); ?>" method="POST" id="login-Form">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <input type="text" placeholder="Email Address" name="user_email"
                               class="form-control input-lg p-input" id="user_email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="user_password" placeholder="Password" class="form-control input-lg p-input"
                               id="user_password">
                    </div>
                    <div class="form-group">
                        Forgot your password? <a href="<?php echo e(url('/user/reset_password')); ?>" style="color:orangered;">Reset it now</a>
                    </div>
                    <button type="submit" class="btn btn-default btn-lg btn-block p-signup-btn">Log In</button>

                </form>
                <div class="clear"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>