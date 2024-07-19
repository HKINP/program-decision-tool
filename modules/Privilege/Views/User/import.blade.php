<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Import Users From Spreadsheet</h4>
</div>
<div class="modal-body">
    <div class="form-group col-md-12 col-xs-12">
        <label for="item">
            <a href="{{ asset('samples/import_users.xlsx') }}" title="Click here to download">
                <i class="fa fa-download"> </i> Click here to download sample spreadsheet file.
            </a>
        </label>
    </div>
    <div class="clearfix"></div>
    <div class="form-group col-md-12 col-xs-12">
        <label for="item">Attachment *</label>
        <input type="file" name="attachment" class="form-control attachment" required="required">
    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary save_button">Import</button>
</div>