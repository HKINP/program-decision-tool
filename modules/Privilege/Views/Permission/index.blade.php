@extends('layout.containerlist')
@section('title', 'Permissions')
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            ScmDatatable.init();

            $('#sidebar li').removeClass('active');
            $('#sidebar a').removeClass('active');
            $('#sidebar').find('#privilege').addClass('active');
            $('#sidebar').find('#permission').addClass('active');
            var oTable = $('#permission-table').dataTable();

            $('#permissionAddForm').formValidation({
                framework: 'bootstrap',
                excluded: ':disabled',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    permission_name: {
                        validators: {
                            notEmpty: {
                                message: 'The permission name is required.'
                            }
                        }
                    },
                    guard_name: {
                        validators: {
                            notEmpty: {
                                message: 'The guard name is required.'
                            }
                        }
                    },
                }
            }).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target),
                    fv = $form.data('formValidation');
                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        swal('Success', response.message, 'success');
                        $('#permissionAddModal').modal('hide');

                        var rowIndex = oTable.fnAddData([
                            '<i class="fa fa-arrows"></i>',
                            '',
                            response.permission.permission_name,
                            response.permission.guard_name,
                            '<a data-toggle="modal" href="'+ rootUrl +'/permission/'+response.permission.id+'/edit"'+
                            'data-target="#permissionEditModal" title="Edit Permission">'+
                            '<i class="fa fa-edit" aria-hidden="true"></i>'+
                            '</a>&nbsp;'+
                            '<a class="delete-permission" href="javascript:;" id="'+ response.permission.id +'" title="Delete Permission"><i class="fa fa-trash-o"></i></a>',
                        ]);
                        var rowTr = oTable.fnGetNodes( rowIndex[0] );
                        $(rowTr).addClass('gradeX').attr('id', 'row_'+response.permission.id );
                        $('td', rowTr)[0].setAttribute('class', '');
                        $('td', rowTr)[1].setAttribute('class', 'serial');
                        $('td', rowTr)[2].setAttribute('class', 'permission_name');
                        $('td', rowTr)[3].setAttribute('class', 'guard_name');
                        $('td', rowTr)[4].setAttribute('class', 'options');
                    },
                    error: function (e) {
                        showErrorMessageInSweatAlert(e);
                    },
                });
            });

            $('#tablebody').on('click', '.delete-permission', function (e) {
                e.preventDefault();
                $object = $(this);
                var id = $object.attr('id');
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function () {
                    $.ajax({
                        type: "DELETE",
                        url: rootUrl +"/privilege/permission/" + id,
                        dataType: 'json',
                        success: function (response) {
                            var nRow = $($object).parents('tr')[0];
                            var tableId = $object.parents('table').attr('id');
                            var oTable = $('#' + tableId).dataTable();
                            oTable.fnDeleteRow(nRow);
                            swal('Success', response.message, 'success');
                        },
                        error: function (e) {
                            showErrorMessageInSweatAlert(e);
                        }
                    });
                });
            });

            $('#permissionEditForm').formValidation({
                framework: 'bootstrap',
                excluded: ':disabled',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    permission_name: {
                        validators: {
                            notEmpty: {
                                message: 'The permission name is required.'
                            }
                        }
                    },
                    guard_name: {
                        validators: {
                            notEmpty: {
                                message: 'The guard name is required.'
                            }
                        }
                    },
                }
            }).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target),
                    fv = $form.data('formValidation');
                $.ajax({
                    type: "PUT",
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        swal('Success', response.message, 'success');
                        $('#permissionEditForm')[0].reset();
                        $('#tablebody').find('#row_' + response.permission.id).find('.permission_name').text(response.permission.name);
                        $('#tablebody').find('#row_' + response.permission.id).find('.guard_name').text(response.permission.guard_name);
                        $('#permissionEditModal').modal('hide');
                    },
                    error: function (e) {
                        showErrorMessageInSweatAlert(e);
                    },
                });
            });

            $('#permissionAddModal').on('hidden.bs.modal', function () {
                $(this).data('bs.modal', null);
                $('#permissionAddModal').removeData('bs.modal');
            });
            $('#permissionEditModal').on('hidden.bs.modal', function () {
                $(this).data('bs.modal', null);
                $('#permissionEditModal').removeData('bs.modal');
            });

        });
    </script>
@endsection
@section('dynamicdata')

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Permissions
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="btn-group">
                            <a data-toggle="modal"
                               href="{!! route('permission.create') !!}" class="btn btn-primary btn-lg"
                               data-target="#permissionAddModal" title="Add Permission">
                                Add New <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                        <table class="table-hover table table-bordered table-striped scm-datatable" id="permission-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>
                                    S N
                                </th>
                                <th>
                                    Permission Name
                                </th>
                                <th>
                                    Guard Name
                                </th>
                                <th>
                                    Updated By
                                </th>
                                <th>
                                    Options
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>
                                </th>
                                <th>
                                    S N
                                </th>
                                <th>
                                    Permission Name
                                </th>
                                <th>
                                    Guard Name
                                </th>
                                <th>
                                    Updated By
                                </th>
                                <th>
                                    Options
                                </th>
                            </tr>
                            </tfoot>
                            <tbody id="tablebody">
                            @foreach($permissions as $index=>$permission)
                                <tr class="gradeX" id="row_{{ $permission->id }}">
                                    <td><i class="fa fa-arrows"></i></td>
                                    <td>
                                        {{ $index+1 }}
                                    </td>
                                    <td class="permission_name">
                                        {{ $permission->permission_name }}
                                    </td>
                                    <td class="guard_name">
                                        {{ $permission->guard_name }}
                                    </td>
                                    <td class="updated_at">
                                        {!! $permission->updatedBy ? ($permission->updatedBy->full_name .' on ' . $permission->updated_at) : 'NA' !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('permission.view', $permission->id) }}" title="View Permission">
                                            <i class="fa fa-lg fa-eye"></i></a>&nbsp;
                                        <a data-toggle="modal"
                                           href="{!! route('permission.edit', $permission->id) !!}"
                                           data-target="#permissionEditModal" title="Edit Permission">
                                            <i class="fa fa-lg fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a class="delete-permission" href="javascript:;" id="{{ $permission->id }}"
                                           title="Delete Permission"><i class="fa fa-lg fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal Start -->
    <div class="modal fade" id="permissionAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <form role="form" id="permissionAddForm" action="{{ route('permission.store') }}" method="post"
                  enctype="multipart/form-data">
                <div class="modal-content"></div>
            </form>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Modal Start -->
    <div class="modal fade" id="permissionEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <form role="form" id="permissionEditForm" action="{{ route('permission.update', 'permission') }}" method="post"
                  enctype="multipart/form-data">
                <div class="modal-content"></div>
            </form>
        </div>
    </div>
    <!-- Modal End -->
@stop
