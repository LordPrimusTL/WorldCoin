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
            <div class="col-lg-3">
                <a href="{{url('/admin/transactions')}}" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">Transactions</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-credit-card" style="font-size:30px"></i></h3>
                            <p class="well-sm">
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">VIEW Account: </P>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{url('/admin/trade-progress')}}" style="text-decoration:none;color:white;">
                    <div class="panel" style="background-color:skyblue;">
                        <div class="panel-heading">
                            <p class="panel-success panel-title text-center">Trade Progress</p>
                        </div>
                        <div class="panel-body">
                            <h3 class="panel-title text-center"><i class="fa fa-calendar" style="font-size:30px"></i></h3>
                            <p class="well-sm">
                            </p>
                        </div>
                        <div class="panel-footer" style="background-color:skyblue;color:white;">
                            <P class="well-sm text-center">View Trading Progress...</P>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                @if($with == true)
                    <a href="{{url('/admin/withdrawals')}}" style="background-color:green;text-decoration:none;color:white;">
                        <div class="panel">
                            <div class="panel-heading" style="background-color:green;">
                                <p class="panel-success panel-title text-center">Withdrawals<b>(99R)</b></p>
                            </div>
                            <div class="panel-body" style="background-color:green;">
                                <h3 class="panel-title text-center"><i class="fa fa-credit-card" style="font-size:30px"></i></h3>
                                <p class="well-sm">
                                </p>
                            </div>
                            <div class="panel-footer" style="background-color:green;color:white;">
                                <P class="well-sm text-center">View Withdrawals History</P>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="{{url('/admin/withdrawals')}}" style="background-color:red;text-decoration:none;color:white;">
                        <div class="panel">
                            <div class="panel-heading"  style="background-color:darkred;color:white;" >
                                <p class="panel-success panel-title text-center">Withdrawals<b>(99R)</b></p>
                            </div>
                            <div class="panel-body" style="background-color:darkred;color:white;">
                                <h3 class="panel-title text-center"><i class="fa fa-credit-card" style="font-size:30px"></i></h3>
                                <p class="well-sm">
                                </p>
                            </div>
                            <div class="panel-footer" style="background-color:darkred;color:white;">
                                <P class="well-sm text-center">View Withdrawals History</P>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection