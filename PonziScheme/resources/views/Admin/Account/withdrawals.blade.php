@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>Withdrawals</h3>
        </div><!--section-title-->
    </div>
@endsection
@section('body')
    <div class="" style="margin-top:30px;">
        <div class="row">
            @include('Partials._message')
            <form method="POST" action="{{url('/admin/trans/search')}}">
                {{csrf_field()}}
                <div class="form-group col-lg-2">
                    <select class="form-control input-sm p-input" name="col_name" id="col_name">
                    </select>
                </div>
                <div class="form-group col-lg-2">
                    <input type="text" class="form-control input-sm p-input" name="with_key" id="trans_key" class="form-control"/>
                </div>
                <div class="form-group col-lg-2">
                    <button class="btn btn-primary input-sm p-input" type="submit"><span class="fa fa-search"></span> Search </button>
                </div>
            </form>
            @if($with)
                <a href="{{url('/admin/with-status/0')}}" class="btn btn-success"><span class="glyphicon glyphicon-check"></span>&nbsp;Withdrawal Is On</a>
            @else
                <a href="{{url('/admin/with-status/1')}}" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span>&nbsp;Withdrawal Is Off</a>
            @endif
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Transaction ID</th>
                    <th>User(Email)</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Balance</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    <?php $i=1?>
                    @foreach($transs as $trans)
                        @if($trans->ts_id == 1)
                            <tr class="alert-success">
                                <td>{{$i++}}</td>
                                <td>{{date('F d, Y H:i:s', strtotime($trans->created_at))}}</td>
                                <td>{{$trans->t_id}}</td>
                                <td><a class="btn btn-primary" href="{{url('/admin/user/view/'.$trans->user_id)}}">{{\App\User::find($trans->user_id)->email}}</a></td>
                                <td>{{'$'.$trans->Amount}}</td>
                                <td>{{$trans->transaction_description}}</td>
                                <td>{{\App\transaction_type::find($trans->t_type)->type}}</td>
                                <td>{{\App\transaction_status::find($trans->ts_id)->status}}</td>
                                <td>{{'$'.$trans->current_balance}}</td>
                                <td>No Action Needed</td>
                            </tr>
                        @elseif($trans->ts_id == 2 || $trans->ts_id == 4 || $trans->ts_id == 5)
                            <tr class="alert-danger">
                                <td>{{$i++}}</td>
                                <td>{{date('F d, Y H:i:s', strtotime($trans->created_at))}}</td>
                                <td>{{$trans->t_id}}</td>
                                <td><a class="btn btn-primary" href="{{url('/admin/user/view/'.$trans->user_id)}}">{{\App\User::find($trans->user_id)->email}}</a></td>
                                <td>{{'$'.$trans->Amount}}</td>
                                <td>{{$trans->transaction_description}}</td>
                                <td>{{\App\transaction_type::find($trans->t_type)->type}}</td>
                                @if($trans->ts_id == 4)
                                    <td>Cancelled by User</td>
                                @elseif($trans->ts_id == 5)
                                    <td>Cancelled by User</td>
                                @else
                                    <td>Cancelled by Unknwon Cause</td>
                                @endif
                                <td>{{'$'.$trans->current_balance}}</td>
                                <td>No Action Needed</td>
                            </tr>
                        @elseif($trans->ts_id == 3)
                            <tr class="alert-warning">
                                <td>{{$i++}}</td>
                                <td>{{date('F d, Y H:i:s', strtotime($trans->created_at))}}</td>
                                <td>{{$trans->t_id}}</td>
                                <td><a class="btn btn-primary" href="{{url('/admin/user/view/'.$trans->user_id)}}">{{\App\User::find($trans->user_id)->email}}</a></td>
                                <td>{{'$'.$trans->Amount}}</td>
                                <td>{{$trans->transaction_description}}</td>
                                <td>{{\App\transaction_type::find($trans->t_type)->type}}</td>
                                <td>{{\App\transaction_status::find($trans->ts_id)->status}}</td>
                                <td>{{'$'.$trans->current_balance}}</td>
                                <td>
                                    @if($trans->tn_id == 1)
                                        <a class="btn btn-info" href="{{url('/admin/trade/approve/'.$trans->t_id)}}"><span class="glyphicon glyphicon-check"></span>&nbsp; Approve</a>
                                        <a class="btn btn-info" href="{{url('/admin/trade/cancel/'.$trans->t_id)}}"><span class="glyphicon glyphicon-trash"></span>&nbsp; Delete</a>
                                    @elseif($trans->tn_id == 2 || $trans->tn_id == 4)
                                        <a class="btn btn-info" href="{{url('/admin/withdrawal/approve/'.$trans->t_id)}}"><span class="glyphicon glyphicon-check"></span>&nbsp; Approve</a>
                                        <a class="btn btn-info" href="{{url('/admin/withdrawal/cancel/'.$trans->t_id)}}"><span class="glyphicon glyphicon-trash"></span>&nbsp; Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @elseif($trans->ts_id == 6)
                            <tr style="background-color: #cbb956">
                                <td>{{$i++}}</td>
                                <td>{{date('F d, Y H:i:s', strtotime($trans->created_at))}}</td>
                                <td>{{$trans->t_id}}</td>
                                <td><a class="btn btn-primary" href="{{url('/admin/user/view/'.$trans->user_id)}}">{{\App\User::find($trans->user_id)->email}}</a></td>
                                <td>{{'$'.$trans->Amount}}</td>
                                <td>{{$trans->transaction_description}}</td>
                                <td>{{\App\transaction_type::find($trans->t_type)->type}}</td>
                                <td>{{\App\transaction_status::find($trans->ts_id)->status}}</td>
                                <td>{{'$'.$trans->current_balance}}</td>
                                <td>
                                    <a class="btn btn-danger" href="{{url('/admin/withdrawal/cancel/'.$trans->t_id)}}"><span class="glyphicon glyphicon-trash"></span>&nbsp; Cancel</a>
                                </td>
                            </tr>
                        @elseif($trans->ts_id == 7)
                            <tr style="background-color: #cbb956">
                                <td>{{$i++}}</td>
                                <td>{{date('F d, Y H:i:s', strtotime($trans->created_at))}}</td>
                                <td>{{$trans->t_id}}</td>
                                <td><a class="btn btn-primary" href="{{url('/admin/user/view/'.$trans->user_id)}}">{{\App\User::find($trans->user_id)->email}}</a></td>
                                <td>{{'$'.$trans->Amount}}</td>
                                <td>{{$trans->transaction_description}}</td>
                                <td>{{\App\transaction_type::find($trans->t_type)->type}}</td>
                                <td>{{\App\transaction_status::find($trans->ts_id)->status}}</td>
                                <td>{{'$'.$trans->current_balance}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{url('/admin/withdrawal/complete/'.$trans->t_id)}}"><span class="glyphicon glyphicon-check"></span>&nbsp; Completed</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection