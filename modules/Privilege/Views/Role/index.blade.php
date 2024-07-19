@extends('layout.containerlist')
@section('title', 'Roles')
@section('footer_js')
<script type="text/javascript">
    $(document).ready(function() {
        ScmDatatable.init();
        $('#sidebar li').removeClass('active');
        $('#sidebar a').removeClass('active');
        $('#sidebar').find('#privilege').addClass('active');
        $('#sidebar').find('#role').addClass('active');
    });
</script>
@endsection
@section('dynamicdata')

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Roles
            </header>
            <div class="panel-body">
                @include('layout.alert')
                <div class="adv-table editable-table ">                	
                	<div class="btn-group">
                        <a href="{{ route('role.create') }}" class="btn btn-primary btn-lg" data-toggle="modal">
                          Add New <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <table class="table-hover table table-bordered table-striped scm-datatable" id="role-table">
                        <thead>
                            <tr>
                                <th>
                                    S N
                                </th>
                                <th>
                                    Role Name
                                </th>
                                <th>
                                    Updated By
                                </th>  
                                <th>
                                    Options
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tablebody">
                            @foreach($roles as $index=>$role)
                            <tr class="gradeX" id="row_{{ $role->id }}" >
                                <td class="index">
                                    {{ ++$index }}
                                </td>
                                <td class="name">
                                    {{ $role->role }}
                                </td>                                
                                <td class="updated_at">
                                        {!! $role->updatedBy ? ($role->updatedBy->full_name .' on ' . $role->updated_at) : 'NA' !!}
                                    </td>                               
                                <td>
                                    <a href="{{ route('role.view', $role->id) }}" title="View Role">
                                        <i class="fa fa-lg fa-eye"></i></a>&nbsp;
                                	<a class="edit-role" href="{{ route('role.edit', $role->id) }}" id="{{ $role->id }}" title="Edit Role"><i class="fa fa-lg fa-edit"></i></a>&nbsp;
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                    S N
                                </th>
                                <th>
                                    Role Name
                                </th>                               
                                <th>
                                    Updated By
                                </th>                               
                                <th>
                                    Options
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </section>
    </div>
</div>
@stop
