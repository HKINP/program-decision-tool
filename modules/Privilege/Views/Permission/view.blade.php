@extends('layout.containerlist')
@section('title', 'View Permission')
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebar li').removeClass('active');
            $('#sidebar a').removeClass('active');
            $('#sidebar').find('#privilege').addClass('active');
            $('#sidebar').find('#permission').addClass('active');
        });
    </script>
@endsection
@section('dynamicdata')

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Permission : {!! $permission->permission_name !!}
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="btn-group">

                        </div>
                        <table class="table-hover table table-bordered table-striped scm-datatable" id="permission-table">
                            <thead>
                            <tr>
                                <th>
                                    S N
                                </th>
                                <th>
                                    Roles
                                </th>
                                <th>
                                    Users
                                </th>
                            </tr>
                            </thead>
                            <tbody id="tablebody">
                            @foreach($permission->roles as $index=>$role)
                                <tr class="gradeX" id="row_{{ $role->id }}">
                                    <td>
                                        {{ $index+1 }}
                                    </td>
                                    <td>
                                        {{ $role->role }}
                                    </td>
                                    <td>
                                        @foreach($role->users as $user)
                                            {!! $user->full_name !!} - {!! $user->getOfficeName() !!}
                                            @unless($loop->last) <br /> @endunless
                                        @endforeach

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
