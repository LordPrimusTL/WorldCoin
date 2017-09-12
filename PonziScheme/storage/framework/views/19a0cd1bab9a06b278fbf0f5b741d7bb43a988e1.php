<?php $__env->startSection('content-half'); ?>
    <div class="wrap">
        <div class="section-title">
            <h3>Sign Up</h3>
        </div><!--section-title-->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>

    <div class="mid_bg">
        <p class="about-title">Account Information</p>
        <div class="wrap">
            <?php echo $__env->make('Partials._message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="details p-signup">
                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form role="form" id="signup-form" action='<?php echo e(url('/user/signup')); ?>' method='post'
                      class="sign-up-cover">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <input type="text" name="first_name" placeholder="First Name" class="form-control input-lg p-input"
                               id="firstname" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control input-lg p-input"
                               id="lastname" required>
                    </div>
                    <div class="form-group">
                        <p><label for="gender">Gender: </label>
                            <input type="radio"  name="gender" id="gender" checked value="male"> Male
                            <input type="radio" name="gender" id="gender" value="female"> Female</p>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address" class="form-control input-lg p-input"
                               id="email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phonenumber" placeholder="Phone Number e.g +2347010926789"
                               class="form-control input-lg p-input" id="phonenumber" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" required placeholder="Address" class="form-control input-lg p-input" id="address">
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username" class="form-control input-lg p-input"
                               id="username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control input-lg p-input"
                               id="password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_conf" placeholder="Confirm password"
                               class="form-control input-lg p-input" id="password_conf" required>
                    </div>
                    <div class="form-group">
                       <?php if($rf == null): ?>
                            <input type="text" name="referrer" placeholder="Referrer"
                                   class="form-control input-lg p-input" id="referrer">
                        <?php else: ?>
                            <input type="text" name="referrer" placeholder="Referrer"
                                   class="form-control input-lg p-input" id="referrer" value="<?php echo e($rf); ?>"  disabled>
                            <input type="hidden" name="referrer" placeholder="Referrer"
                                   class="form-control input-lg p-input" id="referrer" value="<?php echo e($rf); ?>">
                        <?php endif; ?>
                    </div>
                    <h2>Payment Method</h2>
                    <div class="form-group">
                        <select class="form-control input-lg p-input" name="payment_id" id="payment_id">
                            <option value="1">Bitcoin(BTC)</option>
                            <option value="2">Currency(Naira)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <p>Clicking the register button means you agree with our <a href="<?php echo e(url('/terms-of-service')); ?>">Terms Of Service</a></p>
                    </div>

                    <button type="submit" class="btn btn-default btn-lg btn-block p-signup-btn">Sign Up</button>
                </form>
                <div class="clear"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>