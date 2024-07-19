@extends('layout.containerform')
@section('title', 'Edit User')
@section('footer_js')
<script type="text/javascript">
    $(document).ready(function() {
    	$('#sidebar li').removeClass('active');
        $('#sidebar a').removeClass('active');
        $('#sidebar').find('#privilege').addClass('active');
        $('#sidebar').find('#user').addClass('active');

        $("#role_ids").select2();
        $("#account_code_ids").select2();
        $("#award_code_ids").select2();
        $("#budget_code_ids").select2();
        $("#monitoring_code_ids").select2();
        $(".join_date").datepicker({
            format: 'yyyy-mm-dd',
            endDate: '+0d',
            autoclose: true
        });

        $('#userEditForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                full_name: {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required.'
                        }
                    }
                },
                office_id: {
                    validators: {
                        notEmpty: {
                            message: 'The office is required.'
                        }
                    }
                },
                email_address: {
                    validators: {
                        notEmpty: {message: 'The email address is required'},
                        emailAddress: {message: 'The value is not a valid email address'},
                        stringLength: {max: 512, message: 'Cannot exceed 512 characters'},
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        stringLength: {
                            min: 6,
                            message: 'The password must be more than 6 characters'
                        }
                    }
                },
                confirm_password: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'The confirm password did not match with password'
                        }
                    }
                },
                designation: {
                    validators: {
                        notEmpty: {
                            message: 'The designation is required'
                        },
                    }
                },
                employee_code:{
                    validators:{
                        notEmpty:{
                            message: 'The Employee code is required'
                        }
                    }
                },
                join_date: {
                    validators: {
                        notEmpty: {
                            message: 'The joining date is required'
                        },
                        date: {
                            format: 'YYYY-MM-DD',
                            message: 'The date is not a valid'
                        }
                    }
                },
            }
        }).on('change', '.join_date', function (e) {
            $('#userEditForm').formValidation('revalidateField', 'join_date');
        }).on('change', '.office_id', function(e){
            e.preventDefault();
            $object = $(this);
            var id = $object.val().replace(/^\D+/g, '');
            $.ajax({
                type: "GET",
                url: rootUrl + "/api/configuration/office/"+id+"/users/with/parents",
                dataType: 'json',
                success: function(response){
                    if(Object.keys(response.users).length > 0){
                        htmlToReplace = '<option value="">Select User</option>';
                        for (var key in response.users) {
                            if (response.users.hasOwnProperty(key)) {
                                htmlToReplace += '<option value="' + key + '">' + response.users[key] + '</option>';
                            }
                        }
                    } else {
                        htmlToReplace = '<option value="">Users Not Found</option>';
                    }
                    $($object).closest('form').find('.first_supervisor_id').html(htmlToReplace);
                    $($object).closest('form').find('.second_supervisor_id').html(htmlToReplace);
                },
                error: function(e){
                    $($object).closest('form').find('.first_supervisor_id').html(htmlToReplace);
                    $($object).closest('form').find('.second_supervisor_id').html(htmlToReplace);
                }
            });
        }).on('change', '.award_code_id', function (e) {
                e.preventDefault();
                $object = $(this);
                var awardcodes = $object.val();

                if(awardcodes.length){
                    $.ajax({
                        type: "POST",
                        url: '/api/configuration/awardcode/multiple',
                        dataType: 'json',
                        data: {'award_codes':awardcodes,'_token':'{{csrf_token()}}'},
                        success: function(response){
                            if(Object.keys(response.budgetCodes).length > 0){
                                htmlToReplace = '';
                                response.budgetCodes.forEach(function (budgetCode) {
                                    htmlToReplace += '<option value="' + budgetCode.id + '">' + budgetCode.code +' ('+ budgetCode.description +')</option>';
                                });
                            } else {
                                htmlToReplace = '<option value="">Budget Code Not Found</option>';
                            }
                            $($object).closest('form').find('.budget_code_id').html(htmlToReplace);

                            if(Object.keys(response.monitoringCodes).length > 0){
                                htmlToReplace = '';
                                response.monitoringCodes.forEach(function (monitoringCode) {
                                    htmlToReplace += '<option value="' + monitoringCode.id + '">' + monitoringCode.code +' ('+ monitoringCode.description +')</option>';
                                });
                            } else {
                                htmlToReplace = '<option value="">Monitoring Code Not Found</option>';
                            }
                            $($object).closest('form').find('.monitoring_code_id').html(htmlToReplace);

                            $($object).closest('form').find('select.budget_code_id').select2();
                            $($object).closest('form').find('select.monitoring_code_id').select2();
                        },
                        error: function(e){
                            console.log(e);
                            $($object).closest('form').find('.monitoring_code_id').html('<option value="">Select Code</option>');
                            $($object).closest('form').find('.budget_code_id').html('<option value="">Select Budget Code</option>');
                        }
                    });
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
                    Edit User
                </header>

                <div class="panel-body">

                    @include('layout.alert')

                    <form action="{{ route('user.update', $user->id) }}" id="userEditForm" method="post" enctype="multipart/form-data">

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Full Name *</label>
                            <input type="text" name="full_name" class="form-control full_name" value="{!! old('full_name') ?? $user->full_name !!}" />
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Email Address *</label>
                            <input type="text" name="email_address" class="form-control email_address" value="{!! $user->email_address !!}" />
                        </div>
                        <div class="clearfix"></div>


                        <div class="form-group col-md-6 col-xs-11">
                            <label class="col-md-4">Roles *</label>
                            <select multiple name="roles[]" id="role_ids" style="width:300px" class="populate select_search">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if(in_array($role->id, $userRoles)) selected="selected" @endif>{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Office *</label>
                            <select name="office_id" class="form-control office_id select_search">
                                <option value="">Select Office</option>
                                @foreach($offices as $office)
                                    <option value="{{ $office->id }}" @if($office->id == $user->office_id) selected="selected" @endif>{{ $office->office_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Department *</label>
                            <select name="department_id" class="form-control select_search" >
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" @if($department->id == $user->department_id) selected="selected" @endif>{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Join Date *</label>
                            <input type="text" name="join_date" class="form-control join_date" value="{!! old('join_date') ?? $user->join_date !!}" />
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Phone Number *</label>
                            <input type="text" name="phone_number" class="form-control phone_number" value="{!! old('phone_number') ?? $user->phone_number !!}" />
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Designation *</label>
                            <input type="text" name="designation" class="form-control designation" value="{!! old('designation') ?? $user->designation !!}"/>
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Employee Code *</label>
                            <input type="text" name="employee_code" class="form-control employee_code" value="{!! old('employee_code') ?? $user->employee_code !!}"/>
                        </div>
                        <div class="clearfix"></div>


                        {{-- <div class="form-group col-md-12 col-xs-11">
                            <label class="col-md-4">Award Codes *</label>
                            <select multiple name="award_codes[]" id="award_code_ids" style="width:40vw;" class="select_search populate award_code_id">
                                @foreach($awardCodes as $awardCode)
                                    <option value="{{ $awardCode->id }}"
                                            @if(in_array($awardCode->id, $user->awardCodes ? $user->awardCodes->pluck('id')->toArray() : [])) selected="selected" @endif
                                    >{{ $awardCode->getCodeWithDescription() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-12 col-xs-11">
                            <label class="col-md-4">Budget Codes *</label>
                            <select multiple name="budget_codes[]" id="budget_code_ids" style="width:40vw;" class="select_search populate budget_code_id">
                                @foreach($budgetCodes as $budgetCode)
                                    <option value="{{ $budgetCode->id }}"
                                            @if(in_array($budgetCode->id, $user->budgetCodes ? $user->budgetCodes->pluck('id')->toArray() : [])) selected="selected" @endif
                                    >{{ $budgetCode->getCodeWithDescription() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-12 col-xs-11">
                            <label class="col-md-4">Account Codes *</label>
                            <select multiple name="account_codes[]" id="account_code_ids" style="width:40vw;" class="select_search populate">
                                @foreach($accountCodes as $accountCode)
                                    <option value="{{ $accountCode->id }}"
                                            @if(in_array($accountCode->id, $user->accountCodes ? $user->accountCodes->pluck('id')->toArray() : [])) selected="selected" @endif
                                    >{{ $accountCode->getCodeWithDescription() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-12 col-xs-11">
                            <label class="col-md-4">Monitoring Codes *</label>
                            <select multiple name="monitoring_codes[]" id="monitoring_code_ids" style="width:40vw;" class="select_search populate monitoring_code_id">
                                @foreach($monitoringCodes as $monitoringCode)
                                    <option value="{{ $monitoringCode->id }}"
                                            @if(in_array($monitoringCode->id, $user->monitoringCodes ? $user->monitoringCodes->pluck('id')->toArray() : [])) selected="selected" @endif
                                    >{{ $monitoringCode->getCodeWithDescription() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div> --}}


                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Status</label>
                            <select name="is_active" class="select_search form-control">
                                <option value="0" {{ !$user->is_active ? 'selected' : '' }} >
                                    Deactive
                                </option>
                                <option value="1" {{ ($user->is_active == 1 || $user->is_active != 0)? 'selected' : '' }} >
                                    Active
                                </option>
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        {!! csrf_field() !!}
                        <input name="_method" type="hidden" value="PUT"/>
                        <input name="id" type="hidden" value="{!! $user->id !!}"/>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>

                </div>

            </div>

        </div>
    </div>
@stop
