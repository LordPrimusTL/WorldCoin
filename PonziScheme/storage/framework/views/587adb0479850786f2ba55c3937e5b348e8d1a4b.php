<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3><?php echo e($pageName); ?></h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="container" style="margin-top:30px;">
        <div class="row">
            <div class="col-lg-3">
                <a href="<?php echo e(url('/admin/users')); ?>" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">Users</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-user" style="font-size:30px"></i></h3>
                            <p class="well-sm">
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">VIEW USERS</P>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="<?php echo e(url('/admin/accounts')); ?>" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">Accounts and Transaction</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-credit-card" style="font-size:30px"></i></h3>
                            <p class="well-sm">
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">View More...</P>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>