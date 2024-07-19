@extends('layout.containerlist')
@section('header_css')

@endsection
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebar li').removeClass('active');
            $('#sidebar a').removeClass('active');
            $('#sidebar').find('#privilege').addClass('active');
            $('#sidebar').find('#user').addClass('active');
        });
    </script>
@endsection
@section('dynamicdata')

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Assigned Products
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">

                        <table class="table-hover table table-bordered table-striped" id="product-table">
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
                                    Start Date
                                </th>
                                <th>
                                    End Date
                                </th>
                                <th>
                                    Assigned Condition
                                </th>
                                <th>
                                    Release Condition
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
                                    Start Date
                                </th>
                                <th>
                                    End Date
                                </th>
                                <th>
                                    Assigned Condition
                                </th>
                                <th>
                                    Release Condition
                                </th>
                            </tr>
                            </tfoot>
                            <tbody id="tablebody">
                            @foreach($products as $index=>$product)
                                <tr class="gradeX" id="row_{{ $product->id }}">
                                    <td>
                                        {{ $index+1 }}
                                    </td>
                                    <td class="item_name">
                                        {{ $product->product->inventory->getItemName() }}
                                    </td>
                                    <td class="item_code">
                                        {{ $product->product->getItemNumber() }}
                                    </td>
                                    <td class="start_date">
                                        {{ $product->getAssignedFrom() }}
                                    </td>
                                    <td class="end_date">
                                        {{ $product->getAssignedTo() }}
                                    </td>
                                    <td>
                                        {!! $product->conditions_assigned !!}
                                    </td>
                                    <td>
                                        {!! $product->conditions_released !!}
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
