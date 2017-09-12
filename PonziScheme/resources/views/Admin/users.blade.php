@extends('master')
@section('content-half')
    <div class="wrap">
        <div class="section-title">
            <h3>{{$pageName}}</h3>
        </div><!--section-title-->
    </div>
@endsection
@section('body')
    <div class="" style="margin-top:30px; background-color: white">
        <div class="table-responsive">
            @include('Partials._message')
            <form method="POST" action="{{url('/admin/user/search')}}">
                {{csrf_field()}}
                <div class="form-group col-lg-2">
                    <select class="form-control p-input" name="col_name" id="col_name">
                        @for($i = 0; $i < count($col_list) ; $i++ )
                            <option value="{{$i}}">{{$col_list[$i]}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-lg-2">
                    <input type="text" class="form-control p-input" name="user_key" id="user_key" class="form-control"/>
                </div>
                <div class="form-group col-lg-2">
                    <button class="btn btn-primary p-input" type="submit"><span class="fa fa-search"></span> Search</button>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Activated</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    @foreach($users as $user)
                        @if($user->referrer == null)
                            <?php $referrer = 'N/A';?>
                        @else
                            <?php $referrer = 'User '. $user->referrer;?>
                        @endif
                        @if($user->is_active)
                            <?php $active = 'True';?>
                        @else
                            <?php $active = 'False';?>
                        @endif
                        @if($user->activated)
                            <?php $activated = 'True';?>
                        @else
                            <?php $activated = 'False';?>
                        @endif
                        @if($user->class_id > 0)
                            <?php $class= \App\user_class::find($user->class_id)->name;?>
                        @else
                            <?php $class = 'N/A';?>
                        @endif

                        @if(!$user->activated)
                            <tr class="alert-warning">
                                <td>{{$i++}}</td>
                                <td>{{$user->firstname . ' ' . $user->lastname}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phonenumber}}</td>
                                <td>{{$activated}}</td>
                                <td><a href="{{url('/admin/user/view/'.$user->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-edit">View Profile</span></a></td>
                            </tr>
                        @elseif(!$user->is_active)
                            <tr class="danger">
                                <td>{{$i++}}</td>
                                <td>{{$user->firstname . ' ' . $user->lastname}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phonenumber}}</td>
                                <td>{{$activated}}</td>
                                <td><a href="{{url('/admin/user/view/'.$user->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-edit">View Profile</span></a></td>
                            </tr>
                        @else
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->firstname . ' ' . $user->lastname}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phonenumber}}</td>
                                <td>{{$activated}}</td>
                                <td><a href="{{url('/admin/user/view/'.$user->id)}}" class="btn btn-info"><span class="glyphicon glyphicon-edit">View Profile</span></a></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection