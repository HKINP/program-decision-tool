@extends('layout.containerform')
@section('title', 'Edit Support Staff')
@section('footer_js')
<script type="text/javascript">
    $(document).ready(function() {
    	$('#sidebar li').removeClass('active');
        $('#sidebar a').removeClass('active');
        $('#sidebar').find('#privilege').addClass('active');
        $('#sidebar').find('#supportstaffs').addClass('active');

        $("#account_code_ids").select2();
        $("#award_code_ids").select2();
        $("#budget_code_ids").select2();
        $("#monitoring_code_ids").select2();
        $(".join_date").datepicker({
            format: 'yyyy-mm-dd',
            endDate: '+0d',
            autoclose: true
        });

        $('#SupportStaffEditForm').formValidation({
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
                phone_number: {
                    validators: {
                        notEmpty: {
                            message: 'The phone number is required.'
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
                designation: {
                    validators: {
                        notEmpty: {
                            message: 'The designation is required'
                        },
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
            $('#SupportStaffAddForm').formValidation('revalidateField', 'join_date');
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
                    Edit Support Staff
                </header>

                <div class="panel-body">

                    @include('layout.alert')

                    <form action="{{ route('support.staff.update', $user->id) }}" id="SupportStaffEditForm" method="post" enctype="multipart/form-data">

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Full Name *</label>
                            <input type="text" name="full_name" class="form-control full_name" value="{!! $user->full_name !!}" />
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Phone Number *</label>
                            <input type="text" name="phone_number" class="form-control phone_number" value="{!! $user->phone_number !!}" />
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
                            <label for="">Designation *</label>
                            <input type="text" name="designation" class="form-control designation" value="{!! $user->designation !!}"/>
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Employee Code *</label>
                            <input type="text" name="employee_code" class="form-control employee_code" value="{!! $user->employee_code ? $user->employee_code:'EE' !!}"/>
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Join Date *</label>
                            <input type="text" name="join_date" class="form-control join_date" value="{!! old('join_date') ?? $user->join_date !!}" />
                        </div>
                        <div class="clearfix"></div>


                        <div class="form-group col-md-12 col-xs-11">
                            <label class="col-md-4">Award Codes *</label>
                            <select multiple name="award_codes[]" id="award_code_ids" style="width:40vw;" class="populate award_code_id select_search">
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
                            <select multiple name="budget_codes[]" id="budget_code_ids" style="width:40vw;" class="populate budget_code_id select_search">
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
                            <select multiple name="account_codes[]" id="account_code_ids" style="width:40vw;" class="populate select_search">
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
                            <select multiple name="monitoring_codes[]" id="monitoring_code_ids" style="width:40vw;" class="populate monitoring_code_id select_search">
                                @foreach($monitoringCodes as $monitoringCode)
                                    <option value="{{ $monitoringCode->id }}"
                                            @if(in_array($monitoringCode->id, $user->monitoringCodes ? $user->monitoringCodes->pluck('id')->toArray() : [])) selected="selected" @endif
                                    >{{ $monitoringCode->getCodeWithDescription() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Status</label>
                            <select name="is_active" class="form-control select_search">
                                <option value="0" {!! ($user->is_active == '0')? 'selected="selected"' : '' !!} >
                                    Deactive
                                </option>
                                <option value="1" {!!  ($user->is_active == '1' || $user->is_active == '')? 'selected="selected"' : '' !!} >
                                    Active
                                </option>
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        {!! csrf_field() !!}
                        {!! method_field('PUT') !!}
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>

                </div>

            </div>

        </div>
    </div>
@stop
