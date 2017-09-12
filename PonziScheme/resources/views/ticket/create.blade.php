@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>Open Ticket</h3>
        </div><!--section-title-->
    </div>
@endsection

@section('body')
    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <form class="form-horizontal" method="post" action="{{url('/user/ticket/create')}}">
                    {{csrf_field()}}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-2 control-label">Title</label>

                        <div class="col-lg-10">
                            <input id="title" type="text" class="form-control p-input" name="title" value="{{ old('title') }}">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <label for="category" class="col-md-2 control-label">Category</label>

                        <div class="col-md-10">
                            <select id="category" type="category" class="form-control p-input" name="category">
                                <option value="">Select Category</option>
                                @foreach ($cat as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('category'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                        <label for="priority" class="col-md-2 control-label">Priority</label>

                        <div class="col-md-10">
                            <select id="priority" type="" class="form-control" name="priority">
                                <option value="">Select Priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>

                            @if ($errors->has('priority'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        <label for="message" class="col-md-2 control-label">Message</label>

                        <div class="col-md-10">
                            <textarea rows="10" id="message" class="form-control" name="message"></textarea>

                            @if ($errors->has('message'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-ticket"></i> Open Ticket
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
@endsection