<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>REFERRALS</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
    <div class="container" style="margin-top:20px;">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="ref_link">Referral Link:</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control p-input" value="<?php echo e(\Illuminate\Support\Facades\Auth::user()->r_link); ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-12 table-responsive">

            <br/>
            <br/>
            <br/>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $us = \App\User::find($rf->referred); ?>
                    <tr class="active">
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($us->firstname . ' ' . $us->lastname); ?></td>
                        <td><?php echo e($us->email); ?></td>
                        <td><?php echo e(date('F d, Y H:i:s', strtotime($us->created_at))); ?></td>
                        <td><a href="<?php echo e(url('/user/referral/'.$us->id)); ?>" class="btn btn-primary">View Referrals</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>