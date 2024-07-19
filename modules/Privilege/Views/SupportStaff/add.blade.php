@extends('layout.containerform')
@section('title', 'Add Other Staff')
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

        $('#SupportStaffAddForm').formValidation({
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
                designation: {
                    validators: {
                        notEmpty: {
                            message: 'The designation is required'
                        },
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
                    Add Support Staff
                </header>

                <div class="panel-body">

                    @include('layout.alert')

                    <form action="{{ route('support.staff.store') }}" id="SupportStaffAddForm" method="post" enctype="multipart/form-data">

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Full Name *</label>
                            <input type="text" name="full_name" class="form-control full_name" value="{!! old('full_name') !!}" />
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Phone Number *</label>
                            <input type="text" name="phone_number" class="form-control phone_number" value="{!! old('phone_number') !!}" />
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Office *</label>
                            <select name="office_id" class="form-control office_id select_search">
                                <option value="">Select Office</option>
                                @foreach($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Department</label>
                            <select name="department_id" class="form-control select_search" >
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Designation *</label>
                            <input type="text" name="designation" class="form-control designation" value="{!! old('designation') !!}"/>
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Employee Code *</label>
                            <input type="text" name="employee_code" class="form-control employee_code" value="EE"/>
                        </div>
                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Join Date *</label>
                            <input type="text" name="join_date" class="form-control join_date" value="{!! old('join_date') !!}" />
                        </div>
                        <div class="clearfix"></div>


                        <div class="form-group col-md-12 col-xs-11">
                            <label class="col-md-4">Award Codes *</label>
                            <select multiple name="award_codes[]" id="award_code_ids" style="width:40vw;" class="populate award_code_id select_search">
                                @foreach($awardCodes as $awardCode)
                                    <option value="{{ $awardCode->id }}">{{ $awardCode->getCodeWithDescription() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-12 col-xs-11">
                            <label class="col-md-4">Budget Codes *</label>
                            <select multiple name="budget_codes[]" id="budget_code_ids" style="width:40vw;" class="populate budget_code_id select_search">
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-12 col-xs-11">
                            <label class="col-md-4">Account Codes *</label>
                            <select multiple name="account_codes[]" id="account_code_ids" style="width:40vw;" class="select_search populate">
                                @foreach($accountCodes as $accountCode)
                                    <option value="{{ $accountCode->id }}">{{ $accountCode->getCodeWithDescription() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-12 col-xs-11">
                            <label class="col-md-4">Monitoring Codes *</label>
                            <select multiple name="monitoring_codes[]" id="monitoring_code_ids" style="width:40vw;" class="select_search populate monitoring_code_id">
                                
                            </select>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-6 col-xs-11">
                            <label for="">Status</label>
                            <select name="is_active" class="select_search form-control">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
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
