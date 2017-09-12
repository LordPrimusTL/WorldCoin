@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>Trade Progress...</h3>
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
                    <select class="form-control input-lg p-input" name="col_name" id="col_name">

                    </select>
                </div>
                <div class="form-group col-lg-2">
                    <input type="text" class="form-control input-lg p-input" name="trans_key" id="trans_key" class="form-control"/>
                </div>
                <div class="form-group col-lg-2">
                    <button class="btn btn-primary input-lg p-input" type="submit"><span class="fa fa-search"></span> Search</button>
                </div>
            </form>
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                    <th>S/N</th>
                    <th>Start Date</th>
                    <th>Transaction ID</th>
                    <th>User(Email)</th>
                    <th>Amount</th>
                    <th>Month Used</th>
                    <th>Profit Accummulated</th>
                    <th>Total</th>
                    <th>Active</th>
                    </thead>
                    <tbody>
                    <?php $i=1?>
                    @foreach($data as $d)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{\Carbon\Carbon::parse($d->start_date)->timezone('Africa/Lagos')}}</td>
                            <td>{{$d->t_id}}</td>
                            <td><a class="btn btn-primary" href="{{url('/admin/user/view/'.$d->user_id)}}">{{\App\User::find($d->user_id)->email}}</a></td>
                            <td>{{$d->amount}}</td>
                            <td>{{$d->month_used}}</td>
                            <td>{{$d->profit_acc}}</td>
                            <td>{{$d->total_inv}}</td>
                            <th>{{$d->active}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection