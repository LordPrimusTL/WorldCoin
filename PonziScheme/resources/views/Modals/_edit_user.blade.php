<div id="EditUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit User</h4>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="{{url('/admin/user/edit')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="user_id">User Id: </label>
                            <div class="col-sm-9">
                                <input type="text" disabled name="did"  class="form-control input-lg p-input" id="did"/>
                                <input type="hidden" name="user_id"  id="user_id"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="class_id">Class: </label>
                            <div class=" col-sm-9">
                                <select class="form-control input-lg p-input" name="class_id" id="class_id">
                                    <option value="0">N/A</option>
                                    @foreach(\App\user_class::all() as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="is_active">Active: </label>
                            <div class="col-sm-9">
                                <select class="form-control input-lg p-input" name="is_active" id="is_active">
                                    <option value="0">false</option>
                                    <option value="1">true</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="activated">Activated: </label>
                            <div class=" col-sm-9">
                                <select class="form-control input-lg p-inputp" name="activated" id="activated">
                                    <option value="0">false</option>
                                    <option value="1">true</option>
                                </select>
                            </div>
                        </div>

                        <input type="submit" value="save"/>
                       <div class="pull-right">
                           <button type="submit" class="btn">
                               <span class="glyphicon glyphicon-save"></span> Save
                           </button>
                           <button type="button" class="btn btn-warning" data-dismiss="modal">
                               <span class="glyphicon glyphicon-remove"></span> Close
                           </button>
                       </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>