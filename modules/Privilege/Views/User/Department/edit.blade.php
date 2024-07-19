<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Edit Department of User</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="moduleName">Department</label>
        <select name="department_id" class="select_search form-control department_id">
            @foreach($departments as $id=>$department)
                <option value="{{ $id }}" @if($id == $user->department_id) selected="selected" @endif>{{ $department }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
    <input type="hidden" name="user_id" value="{!! $user->id !!}" />
    <input type="hidden" name="_method" value="PUT" />
</div>