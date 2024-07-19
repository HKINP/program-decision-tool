@extends('layout.containerlist')
@section('title', 'Support and Other Staff Members')
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            ScmDatatable.init();

            $('#sidebar li').removeClass('active');
            $('#sidebar a').removeClass('active');
            $('#sidebar').find('#privilege').addClass('active');
            $('#sidebar').find('#supportstaffs').addClass('active');


            $('#tablebody').on('click', '.delete-user', function (e) {
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
                        url: "{{ url('/privilege/user/') }}" + "/" + id,
                        dataType: 'json',
                        success: function (response) {
                            swal('Success', response.message, 'success');
                        },
                        error: function (e) {
                            showErrorMessageInSweatAlert(e);
                        }
                    });
                });
            });

            $('#tablebody').on('click', '.change-status', function (e) {
                e.preventDefault();
                $object = $(this);
                var id = $object.attr('id');
                swal({
                    title: 'Are you sure?',
                    text: "You are going to change the status!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then(function () {
                    $.ajax({
                        type: "PUT",
                        url: rootUrl + "/privilege/user/change/status/" + id,
                        data: {id: id},
                        dataType: 'json',
                        success: function (response) {
                            swal('Success', response.message, 'success');
                            if (response.user.is_active == 1) {
                                $($object).children().removeClass('fa-ban');
                                $($object).children().addClass('fa-check-square-o');
                                $($object).attr('title', 'Deactivate');
                            } else {
                                $($object).children().removeClass('fa-check-square-o');
                                $($object).children().addClass('fa-ban');
                                $($object).attr('title', 'Activate');
                            }
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
                    Support and Other Staff Members
                </header>
                <div class="panel-body">
                    @include('layout.alert')
                    <div class="adv-table editable-table ">
                        <div class="btn-group">
                            <a href="{{ route('support.staff.create') }}" class="btn btn-primary btn-lg" data-toggle="modal">
                                Add New <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <table class="table-hover table table-bordered table-striped scm-datatable" id="user-table">
                            <thead>
                            <tr>
                                <th>
                                    SN
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Designation
                                </th>
                                <th>
                                    Office
                                </th>
                                <th>
                                    Department
                                </th>
                                <th>
                                    Options
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>
                                    SN
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Designation
                                </th>
                                <th>
                                    Office
                                </th>
                                <th>
                                    Department
                                </th>
                                <th>
                                    Options
                                </th>
                            </tr>
                            </tfoot>
                            <tbody id="tablebody">
                            @foreach($users as $index=>$user)
                                <tr class="gradeX" id="row_{{ $user->id }}">
                                    <td>{!! $index+1 !!}</td>
                                    <td class="full_name">
                                        {{ $user->full_name }}
                                    </td>
                                    <td class="designation">
                                        {{ $user->designation }}
                                    </td>
                                    <td class="office">
                                        {!! $user->getOfficeName() !!}
                                    </td>
                                    <td class="department">
                                        {{ $user->getDepartmentName() }}
                                    </td>
                                    <td>
                                        <a class="edit-user" href="{!! route('support.staff.edit', $user->id) !!}"
                                           title="Edit User"><i class="fa fa-lg fa-edit"></i></a>&nbsp;
                                        <a class="delete-user" href="javascript:;" id="{{ $user->id }}"
                                           title="Delete User"><i class="fa fa-lg fa-trash-o"></i></a>&nbsp;

                                        @if($user->is_active == 1)
                                            <a href="javascript:;" class="change-status" title="Deactivate"
                                               id="{{ $user->id }}"><i class="fa fa-lg fa-check-square-o"></i></a>
                                        @else
                                            <a href="javascript:;" class="change-status" title="Activate"
                                               id="{{ $user->id }}"><i class="fa fa-lg fa-ban"></i></a>
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

@stop
