@extends('layout.containerlist')
@section('title', 'View Role')
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
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
                    Role : {!! $role->role !!}
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="btn-group">

                        </div>
                        <table class="table-hover table table-bordered table-striped scm-datatable" id="role-table">
                            <thead>
                            <tr>
                                <th>
                                    S N
                                </th>
                                <th>
                                    Permissions
                                </th>
                                <th>
                                    Users
                                </th>
                            </tr>
                            </thead>
                            <tbody id="tablebody">

                                <tr class="gradeX" id="">
                                    <td>
                                        {!! $role->role !!}
                                    </td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            {!! $permission->permission_name !!}
                                            @unless($loop->last) <br /> @endunless
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($role->users as $user)
                                            {!! $user->full_name !!}
                                            @unless($loop->last) <br /> @endunless
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>
@stop
