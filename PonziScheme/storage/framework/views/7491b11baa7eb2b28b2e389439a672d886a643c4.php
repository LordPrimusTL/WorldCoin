<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>User Profile</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <div class="mid_bg">
        <p class="about-title">Account Information</p>
        <div class="wrap">
            <div class="details p-signup">
                <?php echo $__env->make('Partials._message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php echo $__env->make('Partials._message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <form role="form" id="signup-form" action='<?php echo e(url('admin/user/edit')); ?>' method='post'
                      class="sign-up-cover">
                    <?php echo e(csrf_field()); ?>


                    <label class="control-label" for="user_id">User Id: </label>
                    <div class="form-group">
                            <input type="text" disabled name="did"  class="form-control input-lg p-input" id="did" value="<?php echo e($user->id); ?>"/>
                            <input type="hidden" name="user_id"  id="user_id" value="<?php echo e($user->id); ?>"/>
                    </div>

                    <label class="control-label">First Name:  </label>
                    <div class="form-group">
                        <input type="text" name="first_name" placeholder="First Name" class="form-control input-lg p-input"
                               id="firstname" value="<?php echo e($user->firstname); ?>" required disabled>
                    </div>
                    <label class="control-label">Last Name:  </label>
                    <div class="form-group">
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control input-lg p-input"
                               id="lastname" value="<?php echo e($user->lastname); ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <p><label for="gender">Gender: </label>
                            <?php if($user->gender == 'male'): ?>
                                <input type="radio"  name="gender" id="gender" checked value="male" disabled> Male
                                <input type="radio" name="gender" id="gender" value="female" disabled> Female</p>
                        <?php else: ?>
                            <input type="radio"  name="gender" id="gender"  value="male" disabled> Male
                            <input type="radio" name="gender" id="gender" checked value="female" disabled> Female</p>
                        <?php endif; ?>
                    </div>
                    <label class="control-label">Email Address:  </label>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address" class="form-control input-lg p-input"
                               id="email" value="<?php echo e($user->email); ?>" required disabled>
                    </div>
                    <label class="control-label">Phone Number:  </label>
                    <div class="form-group">
                        <input type="text" name="phonenumber" placeholder="Phone Number e.g +2347010926789"
                               class="form-control input-lg p-input" id="phonenumber" value="<?php echo e($user->phonenumber); ?>" disabled required>
                    </div>
                    <label class="control-label">Address:  </label>
                    <div class="form-group">
                        <input type="text" name="address" value="<?php echo e($user->address); ?>" required placeholder="Address" disabled class="form-control input-lg p-input" id="address">
                    </div>
                    <label class="control-label">Username:  </label>
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username" class="form-control input-lg p-input"
                               id="username" value="<?php echo e($user->username); ?>" disabled required>
                    </div>
                    <label class="control-label">Referrer:  </label>
                    <div class="form-group">
                        <input type="text" name="referrer" placeholder="Referrer"
                               class="form-control input-lg p-input" id="refferer" disabled value="<?php echo e('User '. $user->referrer); ?>" disabled>
                    </div>
                    <h2>Payment Method</h2>
                    <div class="form-group">
                        <select class="form-control input-lg p-input" name="payment_id" id="payment_id" disabled>
                            <?php if($user->payment_id == 1): ?>
                                <option selected value="1">Bitcoin(BTC)</option>
                                <option  value="2">Currency(Naira)</option>
                            <?php else: ?>
                                <option value="1">Bitcoin(BTC)</option>
                                <option selected value="2">Currency(Naira)</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <label class="control-label" for="class_id">Class: </label>

                    <div class="form-group">
                        <select class="form-control input-lg p-input" name="class_id" id="class_id">
                            <option value="0">N/A</option>
                            <?php for($i = 1; $i < count(\App\user_class::all()) + 1; $i++): ?>
                                <?php $class = \App\user_class::find($i);?>
                                <?php if($i == $user->class_id): ?>
                                        <option selected value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($class->id); ?>"><?php echo e($class->name); ?></option>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <label class="control-label" for="is_active">Active: </label>
                    <div class="form-group">
                        <select class="form-control input-lg p-input" name="is_active" id="is_active">
                            <?php if($user->is_active == true): ?>
                                <option  value="0">false</option>
                                <option selected value="1">true</option>
                            <?php else: ?>
                                <option selected value="0">false</option>
                                <option value="1">true</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <label class="control-label" for="activated">Activated: </label>
                    <div class="form-group">
                        <select class="form-control input-lg p-inputp" name="activated" id="activated">
                            <?php if($user->activated == true): ?>
                                <option  value="0">false</option>
                                <option selected value="1">true</option>
                            <?php else: ?>
                                <option selected value="0">false</option>
                                <option value="1">true</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <p>Kindly Enter your Admin password to effect any change.</p>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control input-lg p-input"
                               id="password" required>
                    </div>
                    <br/>
                    <button type="submit" class="btn btn-default btn-lg btn-block p-signup-btn">Update Profile</button>
                </form>
                <div class="clear"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>