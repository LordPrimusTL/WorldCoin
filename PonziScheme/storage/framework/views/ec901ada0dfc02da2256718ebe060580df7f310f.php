    <div id="page">
        <div id="header">
            <a class="navicon" href="#menu-left" >
            </a>
        </div>
        <nav id="menu-left">
            <ul>
                <?php if(\App\Worker\AuthCheck::AuthUserCheck()): ?>
                    <li class="<?php echo e(Request::is('user/dashboard') ? 'active' : ''); ?>" style="background:skyblue;">
                        <a href="<?php echo e(url('/user/dashboard')); ?>">Home</a>
                    </li>

                    <li class="<?php echo e(Request::is('user/transactions') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/user/transactions')); ?>">Transactions</a>
                    </li>

                    <li class="<?php echo e(Request::is('about') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/about')); ?>">About</a>
                    </li>
                    <li class="<?php echo e(Request::is('terms-of-service') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/terms-of-service')); ?>">Terms Of Service</a>
                    </li>

                    <li class="<?php echo e(Request::is('live-chat') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/live-chat')); ?>">Live Chat</a>
                    </li>
                <?php elseif(\App\Worker\AuthCheck::AuthAdminCheck()): ?>
                    <li class="<?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>" style="background:skyblue;">
                        <a href="<?php echo e(url('/admin/dashboard')); ?>">Home</a>
                    </li>

                    <li class="<?php echo e(Request::is('admin/accounts') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/admin/accounts')); ?>">Accounts</a>
                    </li>

                    <li class="<?php echo e(Request::is('about') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/about')); ?>">About</a>
                    </li>
                    <li class="<?php echo e(Request::is('terms-of-service') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/terms-of-service')); ?>">Terms Of Service</a>
                    </li>

                    <li class="<?php echo e(Request::is('live-chat') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/live-chat')); ?>">Live Chat</a>
                    </li>
                <?php else: ?>
                    <li class="<?php echo e(Request::is('/') ? 'active' : ''); ?>" style="background:skyblue;">
                        <a href="<?php echo e(url('/')); ?>">Home</a>
                    </li>
                    <li class="<?php echo e(Request::is('about') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/about')); ?>">About</a>
                    </li>
                    <li class="<?php echo e(Request::is('term-of-service') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/terms-of-service')); ?>">Terms Of Service</a>
                    </li>
                    <li class="<?php echo e(Request::is('live-chat') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/live-chat')); ?>">Live Chat</a>
                    </li>
                <?php endif; ?>
                <div class="clear"></div>
            </ul>
        </nav>
    </div>
    <div class="header">
        <!---start-wrap---->
        <div class="wrap">
            <div class="header-left">
                <div class="logo">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('images/logo.png')); ?>"/></a>
                </div>
            </div>
            <div class="header-right">
                <div class="top-nav">
                    <?php if(\App\Worker\AuthCheck::AuthUserCheck()): ?>
                        <ul>
                            <li class="<?php echo e(Request::is('user/dashboard') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/user/dashboard')); ?>">Home</a>
                            </li>
                            <li class="<?php echo e(Request::is('user/transactions') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/user/transactions')); ?>">Transaction</a>
                            </li>
                            <li class="<?php echo e(Request::is('signout') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/signout')); ?>">Sign Out</a>
                                <!-- Login Ends Here -->
                            </li>
                        </ul>
                    <?php elseif(\App\Worker\AuthCheck::AuthAdminCheck()): ?>
                        <ul>
                            <li class="<?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/admin/dashboard')); ?>">Home</a>
                            </li>
                            <li class="<?php echo e(Request::is('admin/accounts') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/admin/accounts')); ?>">Account</a>
                            </li>
                            <li class="<?php echo e(Request::is('signout') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/signout')); ?>"><span>Sign Out</span></a>
                                <!-- Login Ends Here -->
                            </li>
                        </ul>
                    <?php else: ?>
                        <ul>
                            <li class="<?php echo e(Request::is('/') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/')); ?>">Home</a>
                            </li>
                            <li class="<?php echo e(Request::is('about') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/about')); ?>">About</a>
                            </li>
                            <li class="<?php echo e(Request::is('signup') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/signup')); ?>"><span>Sign Up</span></a>
                                <!-- Login Ends Here -->
                            </li>
                            <li class="<?php echo e(Request::is('signin') ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/signin')); ?>"><span>Sign In</span></a>
                                <!-- Login Ends Here -->
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>