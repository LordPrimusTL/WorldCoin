@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>REFERRALS</h3>
        </div><!--section-title-->
    </div>
@endsection

@section('body')
    <div class="container" style="margin-top:20px;">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="ref_link">Referral Link:</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control p-input" value="{{\Illuminate\Support\Facades\Auth::user()->r_link}}" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-12 table-responsive">

            <br/>
            <br/>
            <br/>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                @foreach($referrals as $rf)
                    <?php $us = \App\User::find($rf->referred); ?>
                    <tr class="active">
                        <td>{{$i++}}</td>
                        <td>{{$us->firstname . ' ' . $us->lastname}}</td>
                        <td>{{$us->email}}</td>
                        <td>{{date('F d, Y H:i:s', strtotime($us->created_at))}}</td>
                        <td><a href="{{url('/user/referral/'.$us->id)}}" class="btn btn-primary">View Referrals</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection