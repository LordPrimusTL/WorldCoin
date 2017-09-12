    <div id="page">
        <div id="header">
            <a class="navicon" href="#menu-left" >
            </a>
        </div>
        <nav id="menu-left">
            <ul>
                @if(\App\Worker\AuthCheck::AuthUserCheck())
                    <li class="{{Request::is('user/dashboard') ? 'active' : ''}}" style="background:skyblue;">
                        <a href="{{url('/user/dashboard')}}">Home</a>
                    </li>

                    <li class="{{Request::is('user/transactions') ? 'active' : ''}}">
                        <a href="{{url('/user/transactions')}}">Transactions</a>
                    </li>

                    <li class="{{Request::is('about') ? 'active' : ''}}">
                        <a href="{{url('/about')}}">About</a>
                    </li>
                    <li class="{{Request::is('terms-of-service') ? 'active' : ''}}">
                        <a href="{{url('/terms-of-service')}}">Terms Of Service</a>
                    </li>

                    <li class="{{Request::is('live-chat') ? 'active' : ''}}">
                        <a href="{{url('/live-chat')}}">Live Chat</a>
                    </li>
                @elseif(\App\Worker\AuthCheck::AuthAdminCheck())
                    <li class="{{Request::is('admin/dashboard') ? 'active' : ''}}" style="background:skyblue;">
                        <a href="{{url('/admin/dashboard')}}">Home</a>
                    </li>

                    <li class="{{Request::is('admin/accounts') ? 'active' : ''}}">
                        <a href="{{url('/admin/accounts')}}">Accounts</a>
                    </li>

                    <li class="{{Request::is('about') ? 'active' : ''}}">
                        <a href="{{url('/about')}}">About</a>
                    </li>
                    <li class="{{Request::is('terms-of-service') ? 'active' : ''}}">
                        <a href="{{url('/terms-of-service')}}">Terms Of Service</a>
                    </li>

                    <li class="{{Request::is('live-chat') ? 'active' : ''}}">
                        <a href="{{url('/live-chat')}}">Live Chat</a>
                    </li>
                @else
                    <li class="{{Request::is('/') ? 'active' : ''}}" style="background:skyblue;">
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li class="{{Request::is('about') ? 'active' : ''}}">
                        <a href="{{url('/about')}}">About</a>
                    </li>
                    <li class="{{Request::is('term-of-service') ? 'active' : ''}}">
                        <a href="{{url('/terms-of-service')}}">Terms Of Service</a>
                    </li>
                    <li class="{{Request::is('live-chat') ? 'active' : ''}}">
                        <a href="{{url('/live-chat')}}">Live Chat</a>
                    </li>
                @endif
                <div class="clear"></div>
            </ul>
        </nav>
    </div>
    <div class="header">
        <!---start-wrap---->
        <div class="wrap">
            <div class="header-left">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{asset('images/logo.png')}}"/></a>
                </div>
            </div>
            <div class="header-right">
                <div class="top-nav">
                    @if(\App\Worker\AuthCheck::AuthUserCheck())
                        <ul>
                            <li class="{{Request::is('user/dashboard') ? 'active' : ''}}">
                                <a href="{{url('/user/dashboard')}}">Home</a>
                            </li>
                            <li class="{{Request::is('user/transactions') ? 'active' : ''}}">
                                <a href="{{url('/user/transactions')}}">Transaction</a>
                            </li>
                            <li class="{{Request::is('signout') ? 'active' : ''}}">
                                <a href="{{url('/signout')}}">Sign Out</a>
                                <!-- Login Ends Here -->
                            </li>
                        </ul>
                    @elseif(\App\Worker\AuthCheck::AuthAdminCheck())
                        <ul>
                            <li class="{{Request::is('admin/dashboard') ? 'active' : ''}}">
                                <a href="{{url('/admin/dashboard')}}">Home</a>
                            </li>
                            <li class="{{Request::is('admin/accounts') ? 'active' : ''}}">
                                <a href="{{url('/admin/accounts')}}">Account</a>
                            </li>
                            <li class="{{Request::is('signout') ? 'active' : ''}}">
                                <a href="{{url('/signout')}}"><span>Sign Out</span></a>
                                <!-- Login Ends Here -->
                            </li>
                        </ul>
                    @else
                        <ul>
                            <li class="{{Request::is('/') ? 'active' : ''}}">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="{{Request::is('about') ? 'active' : ''}}">
                                <a href="{{url('/about')}}">About</a>
                            </li>
                            <li class="{{Request::is('signup') ? 'active' : ''}}">
                                <a href="{{url('/signup')}}"><span>Sign Up</span></a>
                                <!-- Login Ends Here -->
                            </li>
                            <li class="{{Request::is('signin') ? 'active' : ''}}">
                                <a href="{{url('/signin')}}"><span>Sign In</span></a>
                                <!-- Login Ends Here -->
                            </li>
                        </ul>
                    @endif
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>