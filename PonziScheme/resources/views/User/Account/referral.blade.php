@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>{{$cName}}</h3>
        </div><!--section-title-->
    </div>
@endsection
@section('body')
    <div class="container" style="margin-top:20px;">
        <table class="table table-bordered">
            <thead>
                <th>S/N</th>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Balance</th>
            </thead>
            <tbody>
                <?php $i = 1;?>
                @foreach($trade as $tr)
                    @if($tr->ts_id == 1 || $tr->ts_id == 8)
                        <tr class="alert-success">
                            <td>{{$i++}}</td>
                            <td>{{date('F d, Y H:i:s', strtotime($tr->created_at))}}</td>
                            <td>{{$tr->t_id}}</td>
                            <td>{{'$'.$tr->Amount}}</td>
                            <td>{{'$'.$tr->current_balance}}</td>
                        </tr>
                    @elseif($tr->ts_id == 2 || $tr->ts_id == 4 || $tr->ts_id == 5)
                        <tr class="alert-danger">
                            <td>{{$i++}}</td>
                            <td>{{date('F d, Y H:i:s', strtotime($tr->created_at))}}</td>
                            <td>{{$tr->t_id}}</td>
                            <td>{{'$'.$tr->Amount}}</td>
                            <td>{{'$'.$tr->current_balance}}</td>
                        </tr>
                    @elseif($tr->ts_id == 3)
                        <tr class="alert-warning">
                            <td>{{$i++}}</td>
                            <td>{{date('F d, Y H:i:s', strtotime($tr->created_at))}}</td>
                            <td>{{$tr->t_id}}</td>
                            <td>{{'$'.$tr->Amount}}</td>
                            <td>{{'$'.$tr->current_balance}}</td>
                        </tr>
                    @elseif($tr->ts_id == 6)
                        <tr style="background-color: #cbb956">
                            <td>{{$i++}}</td>
                            <td>{{\Carbon\Carbon::parse($tr->created_at)}}</td>
                            <td>{{$tr->t_id}}</td>
                            <td>{{'$'.$tr->Amount}}</td>
                            <td>{{'$'.$tr->current_balance}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection