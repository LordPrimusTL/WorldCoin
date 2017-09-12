@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>Log In</h3>
        </div><!--section-title-->
    </div>
@endsection
@section('body')
    <!-- start main -->
    <div class="mid_bg">
        <p class="about-title">Account Information</p>
        <div class="wrap">
            <div class="details p-signup">
                @include('Partials._message')
                <form role="form" action="{{ url('user/signin') }}" method="POST" id="login-Form">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" placeholder="Email Address" name="user_email"
                               class="form-control input-lg p-input" id="user_email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="user_password" placeholder="Password" class="form-control input-lg p-input"
                               id="user_password">
                    </div>
                    <div class="form-group">
                        Forgot your password? <a href="{{url('/user/reset_password')}}" style="color:orangered;">Reset it now</a>
                    </div>
                    <button type="submit" class="btn btn-default btn-lg btn-block p-signup-btn">Log In</button>

                </form>
                <div class="clear"></div>
            </div>
        </div>
    </div>
@endsection