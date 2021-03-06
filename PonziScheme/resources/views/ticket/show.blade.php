@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>Show Tickets</h3>
        </div><!--section-title-->
    </div>
@endsection
@section('body')
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                </div>

                <div class="panel-body">
                    @include('Partials._message')

                    <div class="ticket-info">
                        <p>{{ $ticket->message }}</p>
                        <p>Category: {{ $category->name }}</p>
                        <p>
                            @if ($ticket->status === 'Open')
                                Status: <span class="label label-success">{{ $ticket->status }}</span>
                            @else
                                Status: <span class="label label-danger">{{ $ticket->status }}</span>
                            @endif
                        </p>
                        <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>

                    <hr>

                    <div class="comments">
                        @foreach ($comments as $comment)
                            <div class="panel panel-@if($ticket->user->id === $comment->user_id){{"default"}}@else{{"success"}}@endif">
                                <div class="panel panel-heading">
                                    {{ $comment->user->firstname }}
                                    <span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
                                </div>

                                <div class="panel panel-body">
                                    {{ $comment->comment }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="comment-form">
                        <form action="{{ url('/user/tickets/comment') }}" method="POST" class="form">
                            {!! csrf_field() !!}
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="10" id="comment" class="form-control p-input" name="comment" placeholder="Comment Here!"></textarea>
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-send"></span>&nbsp;Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection