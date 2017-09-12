<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3><?php echo e($cName); ?></h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="container" style="margin-top:20px;">
        <table class="table table-bordered">
            <thead>
                <th>S/N</th>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Balance</th>
            </thead>
            <tbody>
                <?php $i = 1;?>
                <?php $__currentLoopData = $trade; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($tr->ts_id == 1 || $tr->ts_id == 8): ?>
                        <tr class="alert-success">
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e(date('F d, Y H:i:s', strtotime($tr->created_at))); ?></td>
                            <td><?php echo e($tr->t_id); ?></td>
                            <td><?php echo e('$'.$tr->Amount); ?></td>
                            <td><?php echo e('$'.$tr->current_balance); ?></td>
                        </tr>
                    <?php elseif($tr->ts_id == 2 || $tr->ts_id == 4 || $tr->ts_id == 5): ?>
                        <tr class="alert-danger">
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e(date('F d, Y H:i:s', strtotime($tr->created_at))); ?></td>
                            <td><?php echo e($tr->t_id); ?></td>
                            <td><?php echo e('$'.$tr->Amount); ?></td>
                            <td><?php echo e('$'.$tr->current_balance); ?></td>
                        </tr>
                    <?php elseif($tr->ts_id == 3): ?>
                        <tr class="alert-warning">
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e(date('F d, Y H:i:s', strtotime($tr->created_at))); ?></td>
                            <td><?php echo e($tr->t_id); ?></td>
                            <td><?php echo e('$'.$tr->Amount); ?></td>
                            <td><?php echo e('$'.$tr->current_balance); ?></td>
                        </tr>
                    <?php elseif($tr->ts_id == 6): ?>
                        <tr style="background-color: #cbb956">
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($tr->created_at)); ?></td>
                            <td><?php echo e($tr->t_id); ?></td>
                            <td><?php echo e('$'.$tr->Amount); ?></td>
                            <td><?php echo e('$'.$tr->current_balance); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>