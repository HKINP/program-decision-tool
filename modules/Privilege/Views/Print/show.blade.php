<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Helen Keller</title>
    <style type="text/css">
        .main-wrapper {
            width:780px;
            margin:auto;
            padding:0px 25px 0 25px;
        }
        body {
            padding:0;
            margin:0;
            font-family:Arial, Helvetica, sans-serif;
        }
        table {
            width:100%
        }
        .page-main-title {
            font-size:18px;
            font-weight:bold;
            text-transform:uppercase;
        }
        .bg-orange {
            background:#E84F03;
            padding:8px;
            color:#fff;
        }
        .whit-btn {
            background: #fff;
            border-radius: 5px;
            font-size: 12px;
            padding: 5px 10px;
            margin-right: 15px;
            color: #000;
            text-decoration: none;
        }
        .table1 tr td {
            border-bottom:1px solid #808080;
            padding:4px 5px 4px 5px;
            border-left:1px solid #808080;
            font-size:11px;
        }
        .table1 tr td:first-child {
            border-left:0;
        }
        .table1 {
            font-size:12px;
            border:1px solid #808080;
            border-bottom:0;
            margin-top:5px;
        }
        .bold {
            font-weight:bold;
        }
        .gray-bg {
            background:#D9D9D9;
            font-weight:bold;
        }
        .innertable tr td {
            border:0;
        }
        .innertable tr td.bordered-td {
            border: 1px solid #808080;
        }
        .radio-box {
            display:inline-block;
            margin-right:15px;
        }
        .radio-box input {
            position:relative;
            top:3px;
        }
        .class-highlight {
            border: 1px solid #ff9560;
            padding: 5px;
            background: #ffdccb;
        }
        .table2 tr th {
            border-bottom:1px solid #808080;
            padding:4px 5px 4px 5px;
            border-left:1px solid #808080;
            font-size:11px;
        }
        .table2 tr td {
            border-bottom:1px solid #808080;
            padding:4px 5px 4px 5px;
            border-left:1px solid #808080;
            font-size:11px;
        }
        .table2 tr td:first-child {
            border-left:0;
        }
        .table2 tr th:first-child {
            border-left:0;
        }
        .table2 {
            font-size:12px;
            border:1px solid #808080;
            border-bottom:0;
            border-top:0;
        }
        .sm-italic {
            font-size:10px !important;
            font-style:italic;
        }
        .table3 tr th {
            border-bottom:1px solid #808080;
            padding:4px 5px 4px 5px;
            border-left:1px solid #808080;
            font-size:11px;
        }
        .table3 tr td {
            border-bottom:1px solid #808080;
            padding:4px 5px 4px 5px;
            border-left:1px solid #808080;
            font-size:11px;
        }
        .table3 tr td:first-child {
            border-left:0;
        }
        .table3 tr th:first-child {
            border-left:0;
        }
        .table3 {
            font-size:12px;
            border:1px solid #808080;
            border-bottom:0;
            margin-top:5px;
        }
        .font-sm {
            font-size:13px;
        }
        .center {
            text-align:center;
        }
        .logo-block {
            text-align:right;
        }
        .mrgtop {
            margin-top:15px;
        }
    </style>
</head>

<body>
<div class="main-wrapper">
    @if($printType == 'inventories')
    <h4>Assigned inventories report of {{ $user->getName() }}</h4>
    <p><b>Date: {{ date('d M, Y') }}</b></p>
    <table class="table3 table-hover table-bordered table-striped" id="product-table">
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
                    {{ $allocation->asset->getAssetNumber() }}
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
    @elseif($printType == 'leavesummary')
        <h4>Leave summary report of {{ $user->getName() }}</h4>
        <p><b>Date: {{ date('d M, Y') }}</b></p>
        <table class="table3">
            <thead>
            <tr>
                <th>
                    S N
                </th>
                <th>
                    Fiscal Year
                </th>
                <th>
                    Leave Type
                </th>
                <th>
                    Total Leave
                </th>
                <th>
                    Used Leave
                </th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>
                    S N
                </th>
                <th>
                    Fiscal Year
                </th>
                <th>
                    Leave Type
                </th>
                <th>
                    Total Leave
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
    @endif
    <br/>
    <br/>
</div>
</body>
</html>
