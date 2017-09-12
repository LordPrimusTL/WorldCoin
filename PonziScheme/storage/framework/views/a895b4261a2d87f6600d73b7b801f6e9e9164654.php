<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>Open Ticket</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <form class="form-horizontal" method="post" action="<?php echo e(url('/user/ticket/create')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                        <label for="title" class="col-md-2 control-label">Title</label>

                        <div class="col-lg-10">
                            <input id="title" type="text" class="form-control p-input" name="title" value="<?php echo e(old('title')); ?>">

                            <?php if($errors->has('title')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group<?php echo e($errors->has('category') ? ' has-error' : ''); ?>">
                        <label for="category" class="col-md-2 control-label">Category</label>

                        <div class="col-md-10">
                            <select id="category" type="category" class="form-control p-input" name="category">
                                <option value="">Select Category</option>
                                <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            <?php if($errors->has('category')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('category')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group<?php echo e($errors->has('priority') ? ' has-error' : ''); ?>">
                        <label for="priority" class="col-md-2 control-label">Priority</label>

                        <div class="col-md-10">
                            <select id="priority" type="" class="form-control" name="priority">
                                <option value="">Select Priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>

                            <?php if($errors->has('priority')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('priority')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group<?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
                        <label for="message" class="col-md-2 control-label">Message</label>

                        <div class="col-md-10">
                            <textarea rows="10" id="message" class="form-control" name="message"></textarea>

                            <?php if($errors->has('message')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('message')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-ticket"></i> Open Ticket
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>