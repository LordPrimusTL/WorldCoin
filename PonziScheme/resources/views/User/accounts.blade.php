@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>Accounts</h3>
        </div><!--section-title-->
    </div>
@endsection
@section('body')
    <div class="container" style="margin-top:30px;">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{url('/user/account/trade')}}" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">Trade Account</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-user" style="font-size:30px"></i></h3>
                            <p class="well-sm">
                                View Trade Trasactions and Account Balance.
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">VIEW DETAILS</P>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="{{url('/user/account/referral')}}" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">Referral Account</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-bank" style="font-size:30px;"></i></h3>
                            <p class="well-sm" style="text-align: center">
                                View Referral transactions and Referral Account.
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">VIEW DETAILS</P>
                        </div>

                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection