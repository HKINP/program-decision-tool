<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Edit Permission</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="moduleName">Parent Permission</label>
        <select name="parent_id" class="form-control parent_id select_search">
            <option value="0">Parent Itself</option>
            @foreach($permissions as $id=>$child)
                <option value="{{ $id }}" @if($id == $permission->parent_id) selected="selected" @endif>{{ $child }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="moduleName">Permission Name</label>
        <input type="text" name="permission_name" class="form-control" value="{!! $permission->permission_name !!}"
               placeholder="Enter permission name"/>
    </div>
    <div class="form-group">
        <label for="moduleSlug">Guard Name</label>
        <input type="text" name="guard_name" class="form-control" value="{!! $permission->guard_name !!}"
               placeholder="Enter guard name"/>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
    <input type="hidden" name="id" value="{!! $permission->id !!}" />
</div>