<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Change Password of {!! $user->full_name !!}</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="moduleName">Password *</label>
        <input type="password" name="password" class="form-control" />
    </div>
    <div class="form-group">
        <label for="moduleName">Confirm Password *</label>
        <input type="password" name="confirm_password" class="form-control" />
    </div>
    <div class="form-group">
    <input type="checkbox" id="send_email" name="send_email">
    <label for="send_email"> Send changed password to user?</label><br>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Change Password</button>
    <input type="hidden" name="user_id" value="{!! $user->id !!}" />
</div>