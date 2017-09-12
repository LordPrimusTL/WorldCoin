@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>TRANSACTION DETAILS</h3>
        </div><!--section-title-->
    </div>
@endsection

@section('body')
    <div class="container" style="margin-top:20px;">
        <div class="col-lg-12 table-responsive">
            @include('Partials._message')
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1?>
                @foreach($transaction as $trans)
                    @if($trans->ts_id == 1 || $trans->ts_id == 8)
                        <tr class="alert-success">
                            <td>{{$i++}}</td>
                            <td>{{date('F d, Y H:i:s', strtotime($trans->created_at))}}</td>
                            <td>{{$trans->t_id}}</td>
                            <td>{{'$'.$trans->Amount}}</td>
                            <td>{{$trans->transaction_description}}</td>
                            <td>{{\App\transaction_type::find($trans->t_type)->type}}</td>
                            <td>{{\App\transaction_status::find($trans->ts_id)->status}}</td>
                            <td>{{'$'.$trans->current_balance}}</td>
                            <td>N/A</td>
                        </tr>
                    @elseif($trans->ts_id == 2 || $trans->ts_id == 4 || $trans->ts_id == 5)
                        <tr class="alert-danger">
                            <td>{{$i++}}</td>
                            <td>{{date('F d, Y H:i:s', strtotime($trans->created_at))}}</td>
                            <td>{{$trans->t_id}}</td>
                            <td>{{'$'.$trans->Amount}}</td>
                            <td>{{$trans->transaction_description}}</td>
                            <td>{{\App\transaction_type::find($trans->t_type)->type}}</td>
                            <td>{{\App\transaction_status::find($trans->ts_id)->status}}</td>
                            <td>{{'$'.$trans->current_balance}}</td>
                            <td>N/A</td>
                        </tr>
                    @elseif($trans->ts_id == 3)
                        <tr class="alert-warning">
                            <td>{{$i++}}</td>
                            <td>{{date('F d, Y H:i:s', strtotime($trans->created_at))}}</td>
                            <td>{{$trans->t_id}}</td>
                            <td>{{'$'.$trans->Amount}}</td>
                            <td>{{$trans->transaction_description}}</td>
                            <td>{{\App\transaction_type::find($trans->t_type)->type}}</td>
                            <td>{{\App\transaction_status::find($trans->ts_id)->status}}</td>
                            <td>{{'$'.$trans->current_balance}}</td>
                            <td><a href="{{url('/user/transaction/cancel/'.$trans->t_id)}}" onclick="return confirm('Are you sure you want to cancel this transaction?');" class="btn btn-danger"><spam class="glyphicon glyphicon-trash"></spam>&nbsp;Cancel</a></td>
                        </tr>
                    @elseif($trans->ts_id == 6)
                        <tr style="background-color: #cbb956">
                            <td>{{$i++}}</td>
                            <td>{{\Carbon\Carbon::parse($trans->created_at)}}</td>
                            <td>{{$trans->t_id}}</td>
                            <td>{{'$'.$trans->Amount}}</td>
                            <td>{{$trans->transaction_description}}</td>
                            <td>{{\App\transaction_type::find($trans->t_type)->type}}</td>
                            <td>{{\App\transaction_status::find($trans->ts_id)->status}}</td>
                            <td>{{'$'.$trans->current_balance}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{url('/user/trade/view/'.$trans->t_id)}}"><span class="glyphicon glyphicon-search"></span>&nbsp; View Progress</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection