<script type="text/javascript">
     $('#others_specification').hide();
     $('#separation_type').change(function(){
            if($('#separation_type').val()=='Others'){
                $('#others_specification').show();
            }else{
                $('#others_specification').hide();
            }
        });
</script>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Initiate Exit Clearance of {!! $user->full_name !!}</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="moduleName">Resignation Effective Date *</label>
        <input type="date" name="resign_date" class="form-control" />
    </div>
    <div class="form-group">
        <label for="moduleName">Type of separation *</label>
        <select class="form-control" name="separation_type" id="separation_type">
            <option value="">Please Select</option>
            <option value="Resignation">Resignation</option>
            <option value="Termination">Termination</option>
            <option value="Others">Others</option>
        </select>
    </div>
    <div class="form-group" id="others_specification">
        <label for="moduleName">If others, please specify</label>
        <input class="form-control" name="other_reason" type="text" placeholder="If Others, Please specify"/>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Initiate</button>
    <input type="hidden" name="user_id" value="{!! $user->id !!}" />
</div>