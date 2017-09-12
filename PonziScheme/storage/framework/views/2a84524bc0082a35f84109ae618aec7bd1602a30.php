<?php $__env->startSection('content-half'); ?>
    <div class="main">
        <div class="wrap" style="height:300px;">
            <div class="main_left">
                <h2>WORLD COINS MONEY TRADING SCHOOL</h2>
                <p>World Coins Money Trading School is a Peer2peer financial aid community born out of determination to level the ground for everyone financially.</p>
                <div class="buttons">
                    <div class="sign_up">
                        <a href="<?php echo e(url('/signup')); ?>">SIGN UP</a>
                    </div>
                    <div class="learn">
                        <a href="<?php echo e(url('/about')); ?>" class="arrow_btn">Learn More <span class="fa fa-caret-right"></span></a>
                    </div>
                    <div class="clear"> </div>
                </div>
            </div>
            <div class="clear"> </div>
            <!---//End-header---->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="buttom" style="background:skyblue!important;border:1px solid white">
        <div class="wrap">
            <div class="top-grids row" >
                <div class="top-grid col-md-4">
                    <i class="fa fa-edit p-ficon" style="font-size: 40px;"></i>
                    <h3 class="p-summary">INVEST</h3>
                    <p>Invest  <strong>$21</strong> & </strong>Above</strong> and receive 50% profit at the end of every month.</p>
                </div>
                <div class="top-grid col-md-4">
                    <i class="fa fa-hourglass-start p-ficon" style="font-size: 40px;"></i>
                    <h3 class="p-summary">WAIT TO BE MATCHED FOR PAYMENT</h3>
                    <p>After pledging to donate, you'll will be matched to pay 10% within 4 days and you will be matched to pay the rest after 4 days.</p>
                </div>
                <div class="top-grid col-md-4">
                    <i class="fa fa-money p-ficon" style="font-size: 40px;"></i>
                    <h3 class="p-summary">REQUEST FOR HELP</h3>
                    <p>After confirmation of your donation, you would be able to request for help 3 days later.</p>
                </div>
                <div class="clear"> </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>