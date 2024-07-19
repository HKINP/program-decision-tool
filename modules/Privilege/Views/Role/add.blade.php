@extends('layout.containerform')
@section('title', 'Add Role')
@section('footer_js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebar li').removeClass('active');
        $('#sidebar a').removeClass('active');
        $('#sidebar').find('#privilege').addClass('active');
        $('#sidebar').find('#role').addClass('active');

        $('.check-permission').on('change', function (e) {
            if ($('.check-permission:checked').length == $('.check-permission').length) {
                $(this).closest('table').find('.check-all').prop('checked', true);
            } else {
                $(this).closest('table').find('.check-all').prop('checked', false);
            }
        });

        $('.check-all').on('change', function (e) {
            var checked = $(this).is(':checked');
            if (checked) {
                $(this).closest('table').find('.check-permission').prop('checked', true);
            } else {
                $(this).closest('table').find('.check-permission').prop('checked', false);
            }
        });
    });
</script>
@endsection
@section('dynamicdata')

<div class="row">
            <div class="col-md-12">

                <div data-collapsed="0" class="panel">

					<header class="panel-heading">
						Add Role
					</header>

                    <div class="panel-body">
                    	
                    	@include('layout.alert')

                    	<form action="{{ route('role.store') }}" method="post">
                            <div class="form-group col-md-6 col-xs-11">
                                <label for="">Role Name *</label>
                                <input class="form-control form-control-inline input-medium" name="role" type="text" value="{!! old('role') !!}" placeholder="Enter Role Name" />
                            </div>
                            <div class="clearfix"></div>

                            <table class="table-hover table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th colspan="2">
                                        Permissions
                                    </th>
                                </tr>
                                </thead>

                                <tbody id="tablebody">
                                <tr>
                                    <td colspan="2">
                                        <input type="checkbox" name="modules[]" class="check-all" value="all" />
                                        Give All Permissions
                                    </td>
                                </tr>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="permissions[]" class="check-permission" value="{{ $permission->id }}"/>
                                                {{ $permission->permission_name }}
                                        </td>
                                        <td>
                                        @if($permission->childrens)
                                        <table>
                                            @foreach($permission->childrens->chunk(3) as $chunks)
                                                <tr>
                                                    @foreach($chunks as $child)
                                                    <td>
                                                        <input type="checkbox" name="permissions[]" class="check-permission" value="{{ $child->id }}" />
                                                        {{ $child->permission_name }}
                                                    </td>
                                                        @endforeach
                                                </tr>
                                            @endforeach
                                        </table>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="clearfix"></div>

                            <div class="form-group col-md-3 col-xs-11">
                                <label for="">PR Review Limit *</label>
                                <input class="form-control" name="pr_review_limit" type="number" min="0" value="{!! old('pr_review_limit') ? old('pr_review_limit') : 0 !!}" />
                            </div>
                            <div class="form-group col-md-3 col-xs-11">
                                <label for="">PR Approve Limit *</label>
                                <input class="form-control" name="pr_approve_limit" type="number" min="0" value="{!! old('pr_approve_limit') ? old('pr_approve_limit') : 0 !!}" />
                            </div>
                            <div class="form-group col-md-3 col-xs-11">
                                <label for="">PO Approve Limit *</label>
                                <input class="form-control" name="po_approve_limit" type="number" min="0" value="{!! old('pr_approve_limit') ? old('pr_approve_limit') : 0 !!}" />
                            </div>
                            <div class="form-group col-md-3 col-xs-11">
                                <label for="">PI Approve Limit *</label>
                                <input class="form-control" name="pi_approve_limit" type="number" min="0" value="{!! old('pi_approve_limit') ? old('pi_approve_limit') : 0 !!}" />
                            </div>
                            <div class="clearfix"></div>

	                    {!! csrf_field() !!}
	                    <button type="submit" class="btn btn-info">Submit</button>
	                    </form>

                    </div>

                </div>

            </div>
        </div>
@stop
