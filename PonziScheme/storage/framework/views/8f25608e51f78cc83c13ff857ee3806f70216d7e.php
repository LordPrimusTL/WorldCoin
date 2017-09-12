<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>Trade Progress...</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="" style="margin-top:30px;">
        <div class="row">
            <?php echo $__env->make('Partials._message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form method="POST" action="<?php echo e(url('/admin/trans/search')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="form-group col-lg-2">
                    <select class="form-control input-lg p-input" name="col_name" id="col_name">

                    </select>
                </div>
                <div class="form-group col-lg-2">
                    <input type="text" class="form-control input-lg p-input" name="trans_key" id="trans_key" class="form-control"/>
                </div>
                <div class="form-group col-lg-2">
                    <button class="btn btn-primary input-lg p-input" type="submit"><span class="fa fa-search"></span> Search</button>
                </div>
            </form>
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                    <th>S/N</th>
                    <th>Start Date</th>
                    <th>Transaction ID</th>
                    <th>User(Email)</th>
                    <th>Amount</th>
                    <th>Month Used</th>
                    <th>Profit Accummulated</th>
                    <th>Total</th>
                    <th>Active</th>
                    </thead>
                    <tbody>
                    <?php $i=1?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($d->start_date)->timezone('Africa/Lagos')); ?></td>
                            <td><?php echo e($d->t_id); ?></td>
                            <td><a class="btn btn-primary" href="<?php echo e(url('/admin/user/view/'.$d->user_id)); ?>"><?php echo e(\App\User::find($d->user_id)->email); ?></a></td>
                            <td><?php echo e($d->amount); ?></td>
                            <td><?php echo e($d->month_used); ?></td>
                            <td><?php echo e($d->profit_acc); ?></td>
                            <td><?php echo e($d->total_inv); ?></td>
                            <th><?php echo e($d->active); ?></th>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>