<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>MEMBERSHIP PAGE</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="container" style="margin-top:30px;">
        <div class="row">
            <div class="col-lg-4">
                <a href="<?php echo e(url('/user/profile')); ?>" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">PERSONAL DETAILS</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-user" style="font-size:30px"></i></h3>
                            <p class="well-sm">
                                View and Edit your profile.
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">VIEW DETAILS</P>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo e(url('/user/account')); ?>" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">Account</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-bank" style="font-size:30px;"></i></h3>
                            <p class="well-sm">
                                Check Your Accounts.
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">VIEW DETAILS</P>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo e(url('/user/invest')); ?>" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">INVEST NOW</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-edit" style="font-size:30px"></i></h3>
                            <p class="well-sm">
                                Invest and get a 50% increase at the end of the month.
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">Make Investment >></P>
                        </div>

                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <?php if($with == true): ?>
                    <a href="<?php echo e(url('/user/withdrawals')); ?>" style="background-color:green;text-decoration:none;color:white;">
                        <div class="panel" style="background-color:skyblue;">
                            <div class="panel-heading" style="background-color:green;">
                                <p class="panel-success panel-title text-center">Withdrawals</p>
                            </div>
                            <div class="panel-body" style="background-color:green;">
                                <h3 class="panel-title text-center"><i class="fa fa-credit-card" style="font-size:30px"></i>
                                </h3>
                                <p class="well-sm">
                                    View withdrawing history and Apply for withdrawals
                                </p>
                            </div>
                            <div class="panel-footer" style="background-color:green;color:white;">
                                <P class="well-sm text-center">Apply/View</P>
                            </div>
                        </div>
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(url('/user/withdrawals')); ?>" style="background-color:red;text-decoration:none;color:white;">
                        <div class="panel" style="background: darkred;text-decoration:none;color:white;">
                            <div class="panel-heading" style="background: darkred;">
                                <p class="panel-success panel-title text-center">Withdrawals</p>
                            </div>
                            <div class="panel-body" style="background: darkred;">
                                <h3 class="panel-title text-center"><i class="fa fa-credit-card" style="font-size:30px"></i></h3>
                                <p class="well-sm">
                                    Check And Apply for Withdrawals
                                </p>
                            </div>
                            <div class="panel-footer" style="background: darkred;">
                                <P class="well-sm text-center">Apply/View</P>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo e(url('/user/transactions')); ?>" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">TRANSACTIONS</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-calendar" style="font-size:30px;"></i></h3>
                            <p class="well-sm">
                                View all your transactions and their details.
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">TRANSACTION DETAILS</P>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo e(url('/user/referral')); ?>" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">REFFERALS</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-users" style="font-size:30px"></i></h3>
                            <p class="well-sm">
                                Check your Referrers
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">VIEW REFFERALS</P>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo e(url('/user/tickets')); ?>"  style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">Ticket</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-users" style="font-size:30px"></i></h3>
                            <p class="well-sm">
                                Check Ticket History
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">VIEW</P>
                        </div>

                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>