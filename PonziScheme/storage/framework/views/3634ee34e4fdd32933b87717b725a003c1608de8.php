<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>Transactions And Balance</h3>
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
                    <select class="form-control input-sm p-input" name="col_name" id="col_name">
                        <?php for($i = 0; $i < count($col_list) ; $i++ ): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($col_list[$i]); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group col-lg-2">
                    <input type="text" class="form-control input-sm p-input" name="trans_key" id="trans_key" class="form-control"/>
                </div>
                <div class="form-group col-lg-2">
                    <button class="btn btn-primary input-sm p-input" type="submit"><span class="fa fa-search"></span> Search</button>
                </div>
            </form>
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Transaction ID</th>
                    <th>User(Email)</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Balance</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    <?php $i=1?>
                    <?php $__currentLoopData = $transs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($trans->ts_id == 1 || $trans->ts_id == 8): ?>
                            <tr class="alert-success">
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e(date('F d, Y H:i:s', strtotime($trans->created_at))); ?></td>
                                <td><?php echo e($trans->t_id); ?></td>
                                <td><a class="btn btn-primary" href="<?php echo e(url('/admin/user/view/'.$trans->user_id)); ?>"><?php echo e(\App\User::find($trans->user_id)->email); ?></a></td>
                                <td><?php echo e('$'.$trans->Amount); ?></td>
                                <td><?php echo e($trans->transaction_description); ?></td>
                                <td><?php echo e(\App\transaction_type::find($trans->t_type)->type); ?></td>
                                <td><?php echo e(\App\transaction_status::find($trans->ts_id)->status); ?></td>
                                <td><?php echo e('$'.$trans->current_balance); ?></td>
                                <td>No Action Needed</td>
                            </tr>
                        <?php elseif($trans->ts_id == 2 || $trans->ts_id == 4 || $trans->ts_id == 5): ?>
                            <tr class="alert-danger">
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e(date('F d, Y H:i:s', strtotime($trans->created_at))); ?></td>
                                <td><?php echo e($trans->t_id); ?></td>
                                <td><a class="btn btn-primary" href="<?php echo e(url('/admin/user/view/'.$trans->user_id)); ?>"><?php echo e(\App\User::find($trans->user_id)->email); ?></a></td>
                                <td><?php echo e('$'.$trans->Amount); ?></td>
                                <td><?php echo e($trans->transaction_description); ?></td>
                                <td><?php echo e(\App\transaction_type::find($trans->t_type)->type); ?></td>
                                <?php if($trans->ts_id == 4): ?>
                                    <td>Cancelled by User</td>
                                <?php elseif($trans->ts_id == 5): ?>
                                    <td>Cancelled by User</td>
                                <?php else: ?>
                                    <td>Cancelled by Unknwon Cause</td>
                                <?php endif; ?>
                                <td><?php echo e('$'.$trans->current_balance); ?></td>
                                <td>No Action Needed</td>
                            </tr>
                        <?php elseif($trans->ts_id == 3): ?>
                            <tr class="alert-warning">
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($trans->created_at)); ?></td>
                                <td><?php echo e($trans->t_id); ?></td>
                                <td><a class="btn btn-primary" href="<?php echo e(url('/admin/user/view/'.$trans->user_id)); ?>"><?php echo e(\App\User::find($trans->user_id)->email); ?></a></td>
                                <td><?php echo e('$'.$trans->Amount); ?></td>
                                <td><?php echo e($trans->transaction_description); ?></td>
                                <td><?php echo e(\App\transaction_type::find($trans->t_type)->type); ?></td>
                                <td><?php echo e(\App\transaction_status::find($trans->ts_id)->status); ?></td>
                                <td><?php echo e('$'.$trans->current_balance); ?></td>
                                <td>
                                    <?php if($trans->tn_id == 1): ?>
                                        <a class="btn btn-info" href="<?php echo e(url('/admin/trade/approve/'.$trans->t_id)); ?>"><span class="glyphicon glyphicon-check"></span>&nbsp; Approve</a>
                                        <a class="btn btn-danger" href="<?php echo e(url('/admin/trade/cancel/'.$trans->t_id)); ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp; Cancel</a>
                                    <?php elseif($trans->tn_id == 2): ?>
                                        <a class="btn btn-info" href="<?php echo e(url('/admin/withdraw/approve/'.$trans->t_id)); ?>"><span class="glyphicon glyphicon-check"></span>&nbsp; Approve</a>
                                        <a class="btn btn-danger" href="<?php echo e(url('/admin/withdraw/cancel/'.$trans->t_id)); ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp; Cancel</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php elseif($trans->ts_id == 6): ?>
                            <tr style="background-color: #cbb956">
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e(date('F d, Y H:i:s', strtotime($trans->created_at))); ?></td>
                                <td><?php echo e($trans->t_id); ?></td>
                                <td><a class="btn btn-primary" href="<?php echo e(url('/admin/user/view/'.$trans->user_id)); ?>"><?php echo e(\App\User::find($trans->user_id)->email); ?></a></td>
                                <td><?php echo e('$'.$trans->Amount); ?></td>
                                <td><?php echo e($trans->transaction_description); ?></td>
                                <td><?php echo e(\App\transaction_type::find($trans->t_type)->type); ?></td>
                                <td><?php echo e(\App\transaction_status::find($trans->ts_id)->status); ?></td>
                                <td><?php echo e('$'.$trans->current_balance); ?></td>
                                <td>
                                    <a class="btn btn-danger" href="<?php echo e(url('/admin/trade/cancel/'.$trans->t_id)); ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp; Cancel</a>
                                </td>
                            </tr>
                        <?php elseif($trans->ts_id == 7): ?>
                            <tr style="background-color: lightgoldenrodyellow">
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e(date('F d, Y H:i:s', strtotime($trans->created_at))); ?></td>
                                <td><?php echo e($trans->t_id); ?></td>
                                <td><a class="btn btn-primary" href="<?php echo e(url('/admin/user/view/'.$trans->user_id)); ?>"><?php echo e(\App\User::find($trans->user_id)->email); ?></a></td>
                                <td><?php echo e('$'.$trans->Amount); ?></td>
                                <td><?php echo e($trans->transaction_description); ?></td>
                                <td><?php echo e(\App\transaction_type::find($trans->t_type)->type); ?></td>
                                <td><?php echo e(\App\transaction_status::find($trans->ts_id)->status); ?></td>
                                <td><?php echo e('$'.$trans->current_balance); ?></td>
                                <td>
                                    <a class="btn btn-success" href="<?php echo e(url('/admin/withdrawal/success/'.$trans->t_id)); ?>"><span class="glyphicon glyphicon-check"></span>&nbsp; Success</a>
                                    <a class="btn btn-danger" href="<?php echo e(url('/admin/withdrawal/cancel/'.$trans->t_id)); ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp; Cancel</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>