@extends('layout.containerlist')
@section('header_css')

@endsection
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            var oTable = $('#delegation-table').dataTable();
            var count = oTable.fnSettings().fnRecordsTotal();

            $('#sidebar li').removeClass('active');
            $('#sidebar a').removeClass('active');
            $('#sidebar').find('#privilege').addClass('active');
            $('#sidebar').find('#delegation').addClass('active');

            $('#delegationAddModal').on('hidden.bs.modal', function () {
                $(this).removeData('bs.modal');
                $('#delegationAddForm').formValidation('resetForm', true);
                $('#delegationAddForm').data('formValidation').destroy();
            }).on('shown.bs.modal', function () {
                $('#delegationAddForm').find('.start_date').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate:'+0d',
                    autoclose: true
                });
                $('#delegationAddForm').find('.end_date').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate:'+0d',
                    autoclose: true
                });
                $('#delegationAddForm').formValidation({
                    framework: 'bootstrap',
                    excluded: ':disabled',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        to_user: {
                            validators: {
                                notEmpty: {
                                    message: 'The user must be selected.'
                                }
                            }
                        },
                        start_date: {
                            validators: {
                                notEmpty: {
                                    message: 'The start date is required.'
                                },
                                date: {
                                    format: 'YYYY-MM-DD',
                                    max: 'end_date',
                                    message: 'The start date is not a valid'
                                }
                            }
                        },
                        end_date: {
                            validators: {
                                notEmpty: {
                                    message: 'The end date is required.'
                                },
                                date: {
                                    format: 'YYYY-MM-DD',
                                    min: 'start_date',
                                    message: 'The end date is not a valid'
                                }
                            }
                        },
                    }
                }).on('change', '.start_date', function (e) {
                    $('#delegationAddForm').formValidation('revalidateField', 'start_date');
                    $('#delegationAddForm').formValidation('revalidateField', 'end_date');
                }).on('change', '.end_date', function (e) {
                    $('#delegationAddForm').formValidation('revalidateField', 'start_date');
                    $('#delegationAddForm').formValidation('revalidateField', 'end_date');
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
                            count++;
                            swal('Success', response.message, 'success');
                            $('#delegationAddModal').modal('hide');

                            var optionHtml = '<a href="javascript:;" class="deactivate" title="Deactivate"'+
                                'id="'+response.delegation.id+'"><i class="fa fa-check-square-o"></i></a>';

                            var rowIndex = oTable.fnAddData([
                                count,
                                response.fromUser,
                                response.toUser,
                                response.delegation.start_date,
                                response.delegation.end_date,
                                optionHtml,
                            ]);
                            var rowTr = oTable.fnGetNodes(rowIndex[0]);
                            $(rowTr).addClass('gradeX').attr('id', 'row_' + response.delegation.id);
                            $('td', rowTr)[0].setAttribute('class', 'serial');
                            $('td', rowTr)[1].setAttribute('class', 'from_user');
                            $('td', rowTr)[2].setAttribute('class', 'to_user');
                            $('td', rowTr)[3].setAttribute('class', 'start_date');
                            $('td', rowTr)[4].setAttribute('class', 'end_date');
                            $('td', rowTr)[5].setAttribute('class', 'options');
                        },
                        error: function (e) {
                            showErrorMessageInSweatAlert(e);
                        },
                    });
                });
            });

            $('#delegation-table').on('click', '.deactivate', function (e) {
                e.preventDefault();
                $object = $(this);
                var id = $object.attr('id');
                swal({
                    title: 'Are you sure?',
                    text: "You are going to deactivate this delegation !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, deactivate it!'
                }).then(function () {
                    $.ajax({
                        type: "PUT",
                        url: rootUrl+"/authority/delegation/deactivate/" + id,
                        data: {id: id},
                        dataType: 'json',
                        success: function (response) {
                            swal('Success', response.message, 'success');
                            $('#tablebody').find('#row_'+response.delegation.id).find('.end_date').text(response.delegation.end_date);
                            $($object).html('<i class="fa fa-ban"></i>');
                        },
                        error: function (e) {
                            swal('Oops...', 'Something went wrong!', 'error');
                        }
                    });
                });
            });

        });
    </script>
@endsection
@section('dynamicdata')

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Authority Delegations
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="btn-group">
                            <a data-toggle="modal"
                               href="{!! route('authority.delegation.create') !!}" class="btn btn-primary btn-lg"
                               data-target="#delegationAddModal" title="Add Authority Delegation">
                                Add New <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                        <table class="table-hover table table-bordered table-striped" id="delegation-table">
                            <thead>
                            <tr>
                                <th>
                                    S N
                                </th>
                                <th>
                                    From Name
                                </th>
                                <th>
                                    To Name
                                </th>
                                <th>
                                    Start Date
                                </th>
                                <th>
                                    End Date
                                </th>
                                <th>
                                    Options
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>
                                    S N
                                </th>
                                <th>
                                    From Name
                                </th>
                                <th>
                                    To Name
                                </th>
                                <th>
                                    Start Date
                                </th>
                                <th>
                                    End Date
                                </th>
                                <th>
                                    Options
                                </th>
                            </tr>
                            </tfoot>
                            <tbody id="tablebody">
                            @foreach($delegations as $index=>$delegation)
                                <tr class="gradeX" id="row_{{ $delegation->id }}">
                                    <td>
                                        {{ $index+1 }}
                                    </td>
                                    <td class="from_user">
                                        {{ $delegation->fromUser->full_name }}
                                    </td>
                                    <td class="to_user">
                                        {{ $delegation->toUser->full_name }}
                                    </td>
                                    <td class="start_date">
                                        {{ $delegation->start_date }}
                                    </td>
                                    <td class="end_date">
                                        {{ $delegation->end_date }}
                                    </td>
                                    <td>
                                        @if($user->can('update', $delegation))
                                            @if($delegation->is_active == 1)
                                                <a href="javascript:;" class="deactivate" title="Deactivate"
                                                   id="{{ $delegation->id }}"><i class="fa fa-check-square-o"></i></a>
                                            @else
                                                <i class="fa fa-ban"></i>
                                            @endif
                                        @endif
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
    <div class="modal fade" id="delegationAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <form role="form" id="delegationAddForm" action="{{ route('authority.delegation.store') }}" method="post"
                  enctype="multipart/form-data">
                <div class="modal-content"></div>
            </form>
        </div>
    </div>
    <!-- Modal End -->
@stop
