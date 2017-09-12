@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>PERSONAL DETAILS</h3>
        </div><!--section-title-->
    </div>
@endsection
@section('body')
    <div class="mid_bg">
        <p class="about-title">Account Information</p>
        <div class="wrap">
            <div class="details p-signup">
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
                <form role="form" id="signup-form" action='{{url('/user/profile/edit')}}' method='post'
                      class="sign-up-cover">
                    {{csrf_field()}}

                    <div class="form-group">
                        <input type="text" name="first_name" placeholder="First Name" class="form-control input-lg p-input"
                               id="firstname" value="{{$user->firstname}}" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control input-lg p-input"
                               id="lastname" value="{{$user->lastname}}" required>
                    </div>
                    <div class="form-group">
                        <p><label for="gender">Gender: </label>
                            @if($user->gender == 'male')
                                <input type="radio"  name="gender" id="gender" checked value="male" disabled> Male
                                <input type="radio" name="gender" id="gender" value="female" disabled> Female</p>
                            @else
                                <input type="radio"  name="gender" id="gender"  value="male" disabled> Male
                                <input type="radio" name="gender" id="gender" checked value="female" disabled> Female</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address" class="form-control input-lg p-input"
                               id="email" value="{{$user->email}}" required disabled>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phonenumber" placeholder="Phone Number e.g +2347010926789"
                               class="form-control input-lg p-input" id="phonenumber" value="{{$user->phonenumber}}" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" value="{{$user->address}}" required placeholder="Address" class="form-control input-lg p-input" id="address">
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username" class="form-control input-lg p-input"
                               id="username" value="{{$user->username}}" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="referrer" placeholder="Referrer"
                                   class="form-control input-lg p-input" id="refferer" value="{{$user->referrer}}" disabled>
                    </div>
                    <h2>Payment Method</h2>
                    <div class="form-group">
                        <select class="form-control input-lg p-input" name="payment_id" id="payment_id">
                            @if($user->payment_id == 1)
                                <option selected value="1">Bitcoin(BTC)</option>
                                <option  value="2">Currency(Naira)</option>
                            @else
                                <option value="1">Bitcoin(BTC)</option>
                                <option selected value="2">Currency(Naira)</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <p>Kindly Enter your password to effect any change.</p>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-control input-lg p-input"
                               id="password" required>
                    </div>

                    <p>please click <a href="{{url('/user/change-password')}}">HERE</a>  to change your password</p>
                    <br/>

                    <button type="submit" class="btn btn-default btn-lg btn-block p-signup-btn">Update Profile</button>
                </form>
                <div class="clear"></div>
            </div>
        </div>
    </div>
@endsection