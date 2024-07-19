<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Edit Authority Delegation</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="moduleName">To User</label>
        <select name="to_user" class="form-control to_user select_search">
            <option value="">Select User</option>
            @foreach($users as $id=>$user)
                <option value="{{ $id }}" @if($id == $delegation->to_user) selected="selected" @endif>{{ $user }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="moduleName">Start Date</label>
        <input type="text" name="start_date" class="form-control start_date" value="{!! $delegation->start_date !!}" placeholder="Enter start date"/>
    </div>
    <div class="form-group">
        <label for="moduleSlug">End Date</label>
        <input type="text" name="end_date" class="form-control end_date" value="{!! $delegation->end_date !!}" placeholder="Enter end date"/>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
    <input type="hidden" name="id" value="{!! $delegation->id !!}" />
</div>