<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3><?php echo e($pageName); ?></h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="" style="margin-top:30px; background-color: white">
        <div class="table-responsive">
            <?php echo $__env->make('Partials._message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <form method="POST" action="<?php echo e(url('/admin/user/search')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="form-group col-lg-2">
                    <select class="form-control p-input" name="col_name" id="col_name">
                        <?php for($i = 0; $i < count($col_list) ; $i++ ): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($col_list[$i]); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group col-lg-2">
                    <input type="text" class="form-control p-input" name="user_key" id="user_key" class="form-control"/>
                </div>
                <div class="form-group col-lg-2">
                    <button class="btn btn-primary p-input" type="submit"><span class="fa fa-search"></span> Search</button>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Activated</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->referrer == null): ?>
                            <?php $referrer = 'N/A';?>
                        <?php else: ?>
                            <?php $referrer = 'User '. $user->referrer;?>
                        <?php endif; ?>
                        <?php if($user->is_active): ?>
                            <?php $active = 'True';?>
                        <?php else: ?>
                            <?php $active = 'False';?>
                        <?php endif; ?>
                        <?php if($user->activated): ?>
                            <?php $activated = 'True';?>
                        <?php else: ?>
                            <?php $activated = 'False';?>
                        <?php endif; ?>
                        <?php if($user->class_id > 0): ?>
                            <?php $class= \App\user_class::find($user->class_id)->name;?>
                        <?php else: ?>
                            <?php $class = 'N/A';?>
                        <?php endif; ?>

                        <?php if(!$user->activated): ?>
                            <tr class="alert-warning">
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e($user->firstname . ' ' . $user->lastname); ?></td>
                                <td><?php echo e($user->gender); ?></td>
                                <td><?php echo e($user->username); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->phonenumber); ?></td>
                                <td><?php echo e($activated); ?></td>
                                <td><a href="<?php echo e(url('/admin/user/view/'.$user->id)); ?>" class="btn btn-info"><span class="glyphicon glyphicon-edit">View Profile</span></a></td>
                            </tr>
                        <?php elseif(!$user->is_active): ?>
                            <tr class="danger">
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e($user->firstname . ' ' . $user->lastname); ?></td>
                                <td><?php echo e($user->gender); ?></td>
                                <td><?php echo e($user->username); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->phonenumber); ?></td>
                                <td><?php echo e($activated); ?></td>
                                <td><a href="<?php echo e(url('/admin/user/view/'.$user->id)); ?>" class="btn btn-info"><span class="glyphicon glyphicon-edit">View Profile</span></a></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><?php echo e($i++); ?></td>
                                <td><?php echo e($user->firstname . ' ' . $user->lastname); ?></td>
                                <td><?php echo e($user->gender); ?></td>
                                <td><?php echo e($user->username); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->phonenumber); ?></td>
                                <td><?php echo e($activated); ?></td>
                                <td><a href="<?php echo e(url('/admin/user/view/'.$user->id)); ?>" class="btn btn-info"><span class="glyphicon glyphicon-edit">View Profile</span></a></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>