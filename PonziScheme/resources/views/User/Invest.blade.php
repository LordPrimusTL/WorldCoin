@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>Invest Now</h3>
        </div><!--section-title-->
    </div>
@endsection
@section('body')
    <div class="container" style="margin-top:20px;">
        @include('Partials._message')
        <form method="post" action="{{'/user/invest'}}">
            {{csrf_field()}}
            <div class="form-horizontal">
                <div class="col-md-offset-4 col-md-4">
                    <div class="form-group">
                        <input type="number" min="21" class="form-control input-lg" name="inv_number" id="inv_number" placeholder="Investment Amount" style="border-radius:0!important;"/>
                    </div>
                    <p class="well-sm">
                        Please note that you can only invest $21 and above.
                    </p>
                </div>
                <div class="col-md-offset-4 col-md-4">
                    <div class="form-group">
                        <button class="btn btn-default btn-block input-lg" style="background-color:skyblue;border-radius:0 !important; color: #fff;">Donate</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection