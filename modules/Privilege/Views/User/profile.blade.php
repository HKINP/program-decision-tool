@extends('layout.containerlist')
@section('title', 'Profile')
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebar li').removeClass('active');
            $('#sidebar a').removeClass('active');

            $('.change-attachment').on('click', function (e) {
                $('#editProfileModal').modal().show();
            });

            $('#editProfileModal').on('hidden.bs.modal', function() {
                $('#ProfileEditForm').data('formValidation').destroy();
            }).on('shown.bs.modal', function(){
                $('#ProfileEditForm').formValidation({
                    framework: 'bootstrap',
                    excluded: ':disabled',
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        signature: {
                            validators: {
                                notEmpty: {
                                    message: 'This attachment field is required.'
                                },
                                file: {
                                    extension: 'jpg,jpeg,png',
                                    maxSize: 1048576,
                                    message: 'The selected file is not valid or file size greater than 1 MB.'
                                }
                            }
                        },
                    }
                }).on('success.form.fv', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    var $form = $(e.target),
                        fv    = $form.data('formValidation');
                    $.ajax({
                        type: "POST",
                        url: $form.attr('action'),
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            swal('Success', response.message, 'success');
                            $('#editProfileModal').modal('hide');
                        },
                        error: function(e){
                            showErrorMessageInSweatAlert(e);
                        },
                    });
                });
            });

            $('#delegationAddModal').on('hidden.bs.modal', function () {
                $(this).removeData('bs.modal');
                $('#delegationAddForm').formValidation('resetForm', true);
                $('#delegationAddForm').data('formValidation').destroy();
            }).on('shown.bs.modal', function () {
                // $('#delegationAddForm').find('.start_date').datepicker({
                //     format: 'yyyy-mm-dd',
                //     startDate:'+0d',
                //     autoclose: true
                // });
                // $('#delegationAddForm').find('.end_date').datepicker({
                //     format: 'yyyy-mm-dd',
                //     startDate:'+0d',
                //     autoclose: true
                // });
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
                            swal('Success', response.message, 'success');
                            $('#delegationAddModal').modal('hide');
                            var optionHtml = '<a href="javascript:;" class="deactivate" title="Deactivate"'+
                                'id="'+response.delegation.id+'"><i class="fa fa-lg fa-check-square-o"></i></a>';
                            var htmlToAppend = '<tr class="gradeX" id="row_'+ response.delegation.id +'">'+
                                '<td class="serial"></td>'+
                                '<td class="from_user">'+response.fromUser+'</td>'+
                                '<td class="to_user">'+response.toUser+'</td>'+
                                '<td class="start_date">'+response.delegation.start_date+'</td>'+
                                '<td class="end_date">'+response.delegation.end_date+'</td>'+
                                '<td class="options">'+optionHtml+'</td>'+
                                '</tr>';
                            $('#delegation-table  > tbody:last').append(htmlToAppend);

                            $('#delegation-table').find('.serial').text(function (j) {
                                return j + 1;
                            });
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
                            $($object).html('<i class="fa fa-lg fa-ban"></i>');
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
        <div class="col-md-12">
            <section class="panel">
                <div class="panel-body profile-information">
                    <div class="col-md-3">
                        <div class="profile-pic text-center">
                            @if(file_exists('storage/'.$user->signature) && $user->signature!='')
                                <img src="{{ asset('storage/'.$user->signature) }}" alt="profile"
                                     class="change-attachment" width="300px;">
                            @else
                                <img src="{{ asset('storage/avatar.png') }}" alt="profile" class="change-attachment"
                                     width="300px;">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="profile-desk">
                            <h1>{!! $user->full_name !!}</h1>
                            <span class="text-muted">
                                {!! $user->getDepartmentName() .', '. $user->getOfficeName() !!}
                            </span>
                            <br />
                            <p>
                                Digitizing business processes in Helen Keller International/Nepal with Operations Procedure System (OPS), previously known as LPTS (Logistic and Procurement Tracking System.)<br/>
                                <b>Contact HR for correcting personal information, Admin/Procurement for Roles and Inventory movement, and IS/IT for general tech support</b>. Refer to KellerNet pages for user guides and tutorials on OPS.
                            </p>
                            
                            @if($ecfReq!=null)
                            <p>
                                <b>Your exit clearance has been initated by HR department. Please follow the link to<a target="_blank" href="employee/ecf/new" title="Proceed to Exit Clearance Request"> <u>initate the request</u></a>. If you have any confusion, kindly contact HR or <a target="_blank" title="click here for tutorial" href="https://hkw.sharepoint.com/:b:/t/NP-site/EToKLfnPr3tNkHMNTw5hsvYBfI2YZDG9Wh4nXzuOlHLxHA?e=vklCTH"><u>follow this tutorial here</u></a>.</b>
                            </p>
                            @endif

                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading tab-bg-dark-navy-blue">
                    <ul class="nav nav-tabs nav-justified ">
                        <li class="{{ ($activeTab == 'overview') ? 'active' : ''  }}">
                            <a data-toggle="tab" href="#overview" title="Overview">
                                Overview
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#log-history" title="Log History">
                                Log History
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#delegations" class="contact-map" title="Authority Delegations">
                                Authority Delegations
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#inventories" title="Inventories Assigned">
                                Assigned Inventories
                            </a>
                        </li>
                        <!--li class="{{ ($activeTab == 'summary') ? 'active' : ''  }}">
                            <a data-toggle="tab" href="#leave-summary" title="Leave Summary">
                                Leave Summary
                            </a>
                        </li-->
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="tab-content tasi-tab">
                        <div id="overview" class="tab-pane {{ ($activeTab == 'overview') ? 'active' : ''  }} @if($activeTab == 'overview') active @endif">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="prf-contacts">

                                            <table class="table table-hover table-bordered">
                                                <tr> 
                                                    <td scope="row">
                                                        Name:
                                                    </td>
                                                    <td>
                                                        {!! $user->full_name !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Email Address:
                                                    </td>
                                                    <td>
                                                         {!! $user->email_address !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Phone: 
                                                    </td>
                                                    <td>
                                                         {!! $user->phone_number !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Office:
                                                    </td>
                                                    <td>
                                                        {!! $user->getOfficeName() !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Department:
                                                    </td>
                                                    <td>
                                                        {!! $user->getDepartmentName() !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Designation:
                                                    </td>
                                                    <td>
                                                         {!! $user->designation !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Employee ID:
                                                    </td>
                                                    <td>
                                                        {!! $user->employee_code !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Join Date:
                                                    </td>
                                                    <td>
                                                        {!! $user->join_date !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Roles:
                                                    </td>
                                                    <td>
                                                        @foreach($user->roles as $role)
                                                           {!! $role->role !!}
                                                           @unless(($loop->last)), @endunless
                                                       @endforeach
                                                    </td>
                                                </tr>
                                            </table>
                                        <div class="location-info">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="log-history" class="tab-pane ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="timeline-messages">
                                        <!-- Comment -->

                                        @foreach($userLogs as $log)
                                        <div class="msg-time-chat">
                                            <div class="message-body msg-in">
                                                <span class="arrow"></span>
                                                <div class="text">
                                                    <div class="first">
                                                        {!! $log->getCreatedAt() !!}
                                                    </div>
                                                    <div class="second bg-terques ">
                                                        {!! $log->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- /comment -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="delegations" class="tab-pane ">
                            <div class="row">
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
                                                <td class="serial">
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
                                                               id="{{ $delegation->id }}"><i class="fa fa-lg fa-check-square-o"></i></a>
                                                        @else
                                                            <i class="fa fa-lg fa-ban"></i>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Modal Start -->
                                <div class="modal fade" id="delegationAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                     data-keyboard="false" data-backdrop="static">
                                    <div class="modal-dialog" role="document">
                                        <form role="form" id="delegationAddForm" action="{{ route('authority.delegation.store') }}" method="post"
                                              enctype="multipart/form-data" autocomplete="off">
                                            <div class="modal-content"></div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Modal End -->
                            </div>
                        </div>
                        <div id="inventories" class="tab-pane ">
                            <div class="">
                                <a href="{!! route('user.inventories.print') !!}" class="btn btn-primary pull-right" target="_blank"><i class="fa fa-print"></i> Print</a>
                                <div class="prf-contacts sttng">
                                    <h2>Inventories</h2></br>
                                    <i>Ensure the table below is correct and upto date. Contact logistic team for asset verification.</i>
                                </div>
                                <table class="table table-hover table-bordered table-striped" id="product-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            S N
                                        </th>
                                        <th>
                                            Item Name
                                        </th>
                                        <th>
                                            Item Code
                                        </th>
                                        <th>
                                            Allocation Date
                                        </th>
                                        <th>
                                            Conditions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>
                                            S N
                                        </th>
                                        <th>
                                            Item Name
                                        </th>
                                        <th>
                                            Item Code
                                        </th>
                                        <th>
                                            Allocation Date
                                        </th>
                                        <th>
                                            Conditions
                                        </th>
                                    </tr>
                                    </tfoot>
                                    <tbody id="tablebody">
                                    @foreach($user->assetAllocations as $index=>$allocation)
                                        <tr class="gradeX" id="row_{{ $allocation->id }}">
                                            <td>
                                                {{ $index+1 }}
                                            </td>
                                            <td class="item_name">
                                                {{ $allocation->asset->inventory->getItemName() }}
                                            </td>
                                            <td class="item_code">
                                                <a href="{!! route('inventory.asset.display', $allocation->asset->id) !!}" title="View Asset Detail">
                                                    {{ $allocation->asset->getAssetNumber() }}
                                                </a>
                                            </td>
                                            <td class="start_date">
                                                {{ $allocation->getAllocationDate() }}
                                            </td>
                                            <td>
                                                {!! $allocation->conditions !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div id="leave-summary" class="tab-pane {{ ($activeTab == 'summary') ? 'active' : ''  }}">
                            <div class="">
                                <div class="prf-contacts sttng">
                                    <a href="{!! route('user.leavesummary.print') !!}" class="btn btn-primary pull-right " target="_blank" ><i class="fa fa-print"></i> Print</a>
                                    <h2>Leave Summary</h2>
                                </div>
                                <table class="table table-hover table-bordered table-striped" id="leave-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            SN
                                        </th>
                                        <th>
                                            Fiscal Year
                                        </th>
                                        <th>
                                            Leave Type
                                        </th>
                                        <th>
                                            Earned Leave
                                        </th>
                                        <th>
                                            Used Leave
                                        </th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>
                                            SN
                                        </th>
                                        <th>
                                            Fiscal Year
                                        </th>
                                        <th>
                                            Leave Type
                                        </th>
                                        <th>
                                            Earned Leave
                                        </th>
                                        <th>
                                            Used Leave
                                        </th>
                                    </tr>
                                    </tfoot>
                                    <tbody id="tablebody">
                                    @foreach($user->leaves as $index=>$userLeave)
                                        <tr class="gradeX" id="row_{{ $userLeave->id }}">
                                            <td>
                                                {{ $index+1 }}
                                            </td>
                                            <td class="fiscal_year">
                                                {{ $userLeave->getFiscalYear() }}
                                            </td>
                                            <td class="leave_type">
                                                {{ $userLeave->getLeaveType() }}<br />
                                                {!! $userLeave->leaveType->description !!}
                                            </td>
                                            <td class="earned_days">
                                                {{ $userLeave->earned_days }}
                                            </td>
                                            <td class="used_days">
                                                {{ $userLeave->used_days }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Show edit signature model -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form role="form" id="ProfileEditForm" action="{{ route('user.profile.update') }}" method="post"
                  enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Update Signature</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12 col-xs-11">
                            <label for="attachment">Signature</label>
                            <div class="fileupload fileupload-new normal" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    @if(file_exists('storage/'.$user->signature) && $user->signature!='')
                                        <img src="{{ asset('storage/'.$user->signature) }}" alt="">
                                    @else
                                        <img src="{{ asset('storage/avatar.png') }}" alt="">
                                    @endif
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail"
                                     style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i
                                                    class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists">
                                            <i class="fa fa-undo"></i> Change
                                        </span>
                                        <input type="file" name="signature" class="default"/>
                                    </span>
                                </div>
                            </div>
                            <span class="label label-danger">NOTE!</span>
                            <span>Valid file extensions are jpg,jpeg and png.</span><br/>
                            <span>Image of 300px*300px looks better.</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save_button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

