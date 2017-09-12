<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>WITHDRAWALS</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
    <div class="container" style="margin-top:20px;">

        <div class="col-lg-12 table-responsive">
            <?php echo $__env->make('Partials._message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <a href="#" class="btn btn-primary" id="with_modal"><span class="glyphicon glyphicon-send"></span> Apply For Withdrawal</a>
            <br/>
            <br/>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1?>
                <?php $__currentLoopData = $transaction; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($trans->ts_id == 1): ?>
                        <tr class="alert-success">
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e(date('F d, Y H:i:s', strtotime($trans->created_at))); ?></td>
                            <td><?php echo e($trans->t_id); ?></td>
                            <td><?php echo e('$'.$trans->Amount); ?></td>
                            <td><?php echo e($trans->transaction_description); ?></td>
                            <td><?php echo e(\App\transaction_type::find($trans->t_type)->type); ?></td>
                            <td><?php echo e(\App\transaction_status::find($trans->ts_id)->status); ?></td>
                            <td><?php echo e('$'.$trans->current_balance); ?></td>
                            <td>N/A</td>
                        </tr>
                    <?php elseif($trans->ts_id == 2 || $trans->ts_id == 4 || $trans->ts_id == 5): ?>
                        <tr class="alert-danger">
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e(date('F d, Y H:i:s', strtotime($trans->created_at))); ?></td>
                            <td><?php echo e($trans->t_id); ?></td>
                            <td><?php echo e('$'.$trans->Amount); ?></td>
                            <td><?php echo e($trans->transaction_description); ?></td>
                            <td><?php echo e(\App\transaction_type::find($trans->t_type)->type); ?></td>
                            <td><?php echo e(\App\transaction_status::find($trans->ts_id)->status); ?></td>
                            <td><?php echo e('$'.$trans->current_balance); ?></td>
                            <td>N/A</td>
                        </tr>
                    <?php elseif($trans->ts_id == 3): ?>
                        <tr class="alert-warning">
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e(date('F d, Y H:i:s', strtotime($trans->created_at))); ?></td>
                            <td><?php echo e($trans->t_id); ?></td>
                            <td><?php echo e('$'.$trans->Amount); ?></td>
                            <td><?php echo e($trans->transaction_description); ?></td>
                            <td><?php echo e(\App\transaction_type::find($trans->t_type)->type); ?></td>
                            <td><?php echo e(\App\transaction_status::find($trans->ts_id)->status); ?></td>
                            <td><?php echo e('$'.$trans->current_balance); ?></td>
                            <td><a href="<?php echo e(url('/user/transaction/cancel/'.$trans->t_id)); ?>" onclick="return confirm('Are you sure you want to cancel this transaction?');" class="btn btn-danger"><spam class="glyphicon glyphicon-trash"></spam>&nbsp;Cancel</a></td>
                        </tr>
                    <?php elseif($trans->ts_id == 6): ?>
                        <tr style="background-color: #cbb956">
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($trans->created_at)); ?></td>
                            <td><?php echo e($trans->t_id); ?></td>
                            <td><?php echo e('$'.$trans->nt); ?></td>
                            <td><?php echo e($trans->transaction_description); ?></td>
                            <td><?php echo e(\App\transaction_type::find($trans->t_type)->type); ?></td>
                            <td><?php echo e(\App\transaction_status::find($trans->ts_id)->status); ?></td>
                            <td><?php echo e('$'.$trans->current_balance); ?></td>
                            <td>
                                <a class="btn btn-danger" href="<?php echo e(url('/user/trade/delete/'.$trans->t_id)); ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp; Cancel</a>
                                <a class="btn btn-primary" href="<?php echo e(url('/user/trade/view/'.$trans->t_id)); ?>"><span class="glyphicon glyphicon-search"></span>&nbsp; View Progress</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php echo $__env->make('Modals._with_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>