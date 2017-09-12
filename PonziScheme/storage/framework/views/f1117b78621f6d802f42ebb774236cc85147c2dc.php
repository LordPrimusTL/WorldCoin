<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>PERSONAL DETAILS</h3>
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
                <form role="form" id="signup-form" action='<?php echo e(url('/user/profile/edit')); ?>' method='post'
                      class="sign-up-cover">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <input type="text" name="first_name" placeholder="First Name" class="form-control input-lg p-input"
                               id="firstname" value="<?php echo e($user->firstname); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control input-lg p-input"
                               id="lastname" value="<?php echo e($user->lastname); ?>" required>
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
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address" class="form-control input-lg p-input"
                               id="email" value="<?php echo e($user->email); ?>" required disabled>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phonenumber" placeholder="Phone Number e.g +2347010926789"
                               class="form-control input-lg p-input" id="phonenumber" value="<?php echo e($user->phonenumber); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" value="<?php echo e($user->address); ?>" required placeholder="Address" class="form-control input-lg p-input" id="address">
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username" class="form-control input-lg p-input"
                               id="username" value="<?php echo e($user->username); ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="referrer" placeholder="Referrer"
                                   class="form-control input-lg p-input" id="refferer" value="<?php echo e($user->referrer); ?>" disabled>
                    </div>
                    <h2>Payment Method</h2>
                    <div class="form-group">
                        <select class="form-control input-lg p-input" name="payment_id" id="payment_id">
                            <?php if($user->payment_id == 1): ?>
                                <option selected value="1">Bitcoin(BTC)</option>
                                <option  value="2">Currency(Naira)</option>
                            <?php else: ?>
                                <option value="1">Bitcoin(BTC)</option>
                                <option selected value="2">Currency(Naira)</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <p>Kindly Enter your password to effect any change.</p>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control input-lg p-input"
                               id="password" required>
                    </div>

                    <p>please click <a href="<?php echo e(url('/user/change-password')); ?>">HERE</a>  to change your password</p>
                    <br/>

                    <button type="submit" class="btn btn-default btn-lg btn-block p-signup-btn">Update Profile</button>
                </form>
                <div class="clear"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>