@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>Reset Password</h3>
        </div><!--section-title-->
    </div>
@endsection
@section('body')
    <div class="mid_bg">
        <p class="about-title">{{$form_title}}</p>
        <div class="wrap">
            <div class="details p-signup" id="stage-1-reset">
                @include('Partials._message')
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if($a_email == false)
                    @if($MyAuth == true)
                        <form role="form" action="{{url('/user/change-password')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="password" name="old_password" placeholder="Old Password"
                                       class="form-control input-lg p-input" id="old_password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="new_password" placeholder="New Password"
                                       class="form-control input-lg p-input" id="new_password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="new_conf_password" placeholder="Confirm New Password"
                                       class="form-control input-lg p-input" id="new_conf_password">
                            </div>
                            <input type="submit" class="btn btn-default btn-lg btn-block p-signup-btn" value="Change Password">
                        </form>
                    @else
                        <form role="form" action="{{url('/user/reset-password')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="email" name="reset_email" value="" placeholder="Email Address"
                                       class="form-control input-lg p-input" id="reset_email" required>
                            </div>
                            <button type="submit" class="btn btn-default btn-lg btn-block p-signup-btn">Proceed</button>
                        </form>
                    @endif
                @endif
                <div class="clear"></div>
            </div>

            @if($a_email == true)
                <div class="details p-signup">
                    <form role="form" action="{{url('/user/reset-password/'.$token)}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Your new Password"
                                   class="form-control input-lg p-input" id="reser_password">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_conf" placeholder="Confirm new Password"
                                   class="form-control input-lg p-input" id="reset_conf_password">
                        </div>
                        <input type="submit" class="btn btn-default btn-lg btn-block p-signup-btn" value="Reset Password">
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection