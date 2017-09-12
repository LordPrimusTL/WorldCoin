<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>Tickets</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <br/>
    <br/>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-ticket"> Tickets</i>
                    </div>

                    <div class="panel-body">
                        <?php if($tickets->isEmpty()): ?>
                            <p>There are currently no tickets.</p>
                        <?php else: ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                    <th style="text-align:center" colspan="2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($category->id === $ticket->category_id): ?>
                                                    <?php echo e($category->name); ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(url('/admin/tickets/'. $ticket->ticket_id)); ?>">
                                                #<?php echo e($ticket->ticket_id); ?> - <?php echo e($ticket->title); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <?php if($ticket->status === 'Open'): ?>
                                                <span class="label label-success"><?php echo e($ticket->status); ?></span>
                                            <?php else: ?>
                                                <span class="label label-danger"><?php echo e($ticket->status); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($ticket->updated_at); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('/admin/tickets/'. $ticket->ticket_id)); ?>" class="btn btn-primary"><span class="fa fa-comment"></span>&nbsp;Comment</a>
                                        </td>
                                        <td>
                                            <form action="<?php echo e(url('admin/tickets/close/' . $ticket->ticket_id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>

                                                <button type="submit" class="btn btn-danger"><span class="fa fa-close"></span> &nbsp;Close</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php echo e($tickets->render()); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>