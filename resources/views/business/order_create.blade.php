@extends('business.layouts.app')

@section('title', ' Order Create')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="{{ asset('inspinia') }}/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

@endsection

@section('content')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Orders</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('business.dashboard')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('business.sales')}}">Sales</a>
                    </li>
                    <li>
                        <a href="{{route('business.orders')}}">Orders</a>
                    </li>
                    <li class="active">
                        <strong>Order Create</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight ecommerce">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">

                            <div class="">
                                <form method="post" action="{{ route('business.product.group.store') }}" autocomplete="off" class="form-horizontal form-label-left">
                                    @csrf

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                    {{--  Product  --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <span><i data-toggle="tooltip" data-placement="left" title="Enable this option if all the items in the group are eligible for sales return." class="fa fa-question-circle fa-3x text-warning"></i></span>
                                                </div>
                                                {{--  Salutation  --}}
                                                <div class="col-md-3">
                                                    <div class="has-warning">
                                                        <select class="select2_demo_3 form-control input-lg">
                                                            <option>Select Salutation</option>
                                                            <option value="Bahamas">Bahamas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--  First name  --}}
                                                    <div class="has-warning">
                                                        <input type="text" id="first_name" name="first_name" required="required" class="form-control input-lg" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--  Last name  --}}
                                                    <div class="has-warning">
                                                        <input type="text" id="last_name" name="last_name" required="required" class="form-control input-lg" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            {{--  Comapny name  --}}
                                            <div class="has-warning">
                                                <input type="text" id="company_name" name="company_name" required="required" class="form-control input-lg" placeholder="Company Name">
                                            </div>
                                            <br>
                                            {{--  Customer email  --}}
                                            <div class="">
                                                <input type="email" id="customer_email" name="customer_email" required="required" class="form-control input-lg" placeholder="Customer Email">
                                            </div>
                                            <br>
                                            {{--  Customer phone number  --}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" id="customer_work_phone" name="customer_work_phone" class="form-control input-lg" data-mask="(+999) 999-9999" placeholder="Work Phone">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="customer_mobile" name="customer_mobile" class="form-control input-lg" data-mask="(+999) 999-9999" placeholder="Mobile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    {{--table--}}
                                    <div class="row">
                                        <table class="table table-bordered" id = "estimate_table">
                                            <thead>
                                            <tr>
                                                <th>Item Details</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <select onchange = "itemSelected(this)" data-placement="Select" name="item_details[0][item]" class="select2_demo_3 form-control input-lg item-select">
                                                        <option selected disabled>Select Item</option>
                                                        @foreach($products as $product)
                                                            @if($product->is_service == 0)
                                                                @foreach($product->inventory as $inventory)
                                                                    <option value="{{$product->id}}[{{$inventory->id}}]" data-product-quantity = "{{$inventory->quantity}}" data-product-selling-price = "{{$product->selling_price}}">{{$product->name}} [{{$inventory->warehouse->name}}]</option>
                                                                @endforeach
                                                            @else
                                                                <option value="{{$product->id}}" data-product-quantity = "-20" data-product-selling-price = "{{$product->selling_price}}">{{$product->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input oninput = "changeItemQuantity(this)" name="item_details[0][quantity]" type="number" class="form-control input-lg item-quantity" value = "0" min = "0">
                                                </td>
                                                <td>
                                                    <input oninput = "changeItemRate(this)" name="item_details[0][rate]" type="number" class="form-control input-lg item-rate" placeholder="E.g +10, -10" value = "0" min = "0">
                                                </td>
                                                <td>
                                                    <input oninput = "itemTotalChange()" onchange = "this.oninput()" name="item_details[0][amount]" type="number" class="form-control input-lg item-total" placeholder="E.g +10, -10" value = "0" min = "0">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <label class="btn btn-small btn-primary" onclick = "addTableRow()">+ Add Another Line</label>
                                    </div>

                                    {{--sub totals--}}
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-3 col-md-offset-5">
                                                <label>Sub Total</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input name="subtotal" type = "number" class="pull-right form-control" id = "items-subtotal" readonly value="0">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-1 col-md-offset-5">
                                                <label>Adjustment</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input oninput = "itemTotalChange()" type="number" class="form-control" id = "adjustment-value" value = "0">
                                            </div>
                                            <div class="col-md-1">
                                                <span><i data-toggle="tooltip" data-placement="right" title="Add any other +ve or -ve charges that need to be applied to adjust the total amount of the transaction." class="fa fa-2x fa-question-circle"></i></span>
                                            </div>
                                            <div class="col-md-2">
                                                <p class="pull-right" id = "adjustment-text">0</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3 col-md-offset-5">
                                                <p>Total ()</p>
                                            </div>
                                            <div class="col-md-3">
                                                <input type = "number" name = "grand_total" id = "grand-total" class="pull-right form-control" value = "0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>

                                    <div class="ln_solid"></div>

                                    <br>
                                    {{--attachments--}}
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-1">
                                            <div class="checkbox checkbox-info">
                                                <input id="is_draft" name="is_draft" type="checkbox">
                                                <label for="is_draft">
                                                    Save As Draft
                                                </label>
                                                <span><i data-toggle="tooltip" data-placement="right" title="Check this option if you want to save this as a draft for further editing." class="fa fa-2x fa-question-circle"></i></span>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-block btn-outline btn-lg mt-4">{{ __('Save') }}</button>
                                    </div>

                                </form>

                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>

@endsection

@section('js')



<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- Data picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- FooTable -->
<script src="{{ asset('inspinia') }}/js/plugins/footable/footable.all.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();

        $('#date_added').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#date_modified').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

    });

</script>
<script>
    function itemSelected (e) {
        var selectedItemQuantity = e.options[e.selectedIndex].getAttribute("data-product-quantity");
        var selectItemPrice = e.options[e.selectedIndex].getAttribute("data-product-selling-price");
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var itemQuantity = selectedTr.getElementsByClassName("item-quantity");
        var itemRate = selectedTr.getElementsByClassName("item-rate");
        if (selectedItemQuantity === "-20") {
            itemQuantity[0].setAttribute("max", 100000000);
        } else {
            itemQuantity[0].setAttribute("max", selectedItemQuantity);
        };
        itemRate[0].value = selectItemPrice;
    };
    function changeItemQuantity (e) {
        var quantityValue;
        if (e.value.isEmpty) {
            quantityValue = 0;
        } else {
            quantityValue = e.value;
        };
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var itemRateInputField = selectedTr.getElementsByClassName("item-rate");
        var itemTotalInputField = selectedTr.getElementsByClassName("item-total");
        var itemRate;
        if (itemRateInputField[0].value.isEmpty) {
            itemRate = 0;
        } else {
            itemRate = itemRateInputField[0].value;
        };
        itemTotalInputField[0].value = quantityValue * itemRate;
        itemTotalChange();
    };
    function changeItemRate (e) {
        var subTotal = [];
        var adjustedValue;
        var itemRate;
        if (e.value.isEmpty) {
            itemRate = 0;
        } else {
            itemRate = e.value;
        };
        var selectedParentTd = e.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var itemQuantityInputField = selectedTr.getElementsByClassName("item-quantity");
        var itemTotalInputField = selectedTr.getElementsByClassName("item-total");
        var quantityValue;
        if (itemQuantityInputField[0].value.isEmpty) {
            quantityValue = 0;
        } else {
            quantityValue = itemQuantityInputField[0].value;
        };
        itemTotalInputField[0].value = quantityValue * itemRate;
        itemTotalChange();
    };
    var tableValueArrayIndex = 1;
    function addTableRow () {
        var table = document.getElementById("estimate_table");
        var row = table.insertRow();
        var firstCell = row.insertCell(0);
        var secondCell = row.insertCell(1);
        var thirdCell = row.insertCell(2);
        var fourthCell = row.insertCell(3);
        var fifthCell = row.insertCell(4);
        firstCell.innerHTML = "<select onchange = 'itemSelected(this)' data-placement='Select' name='item_details["+tableValueArrayIndex+"][item]' class='select2_demo_3 form-control input-lg item-select'>"+
                                "<option selected disabled>Select Item</option>"+
                                "@foreach($products as $product)"+
                                "@if($product->is_service == 0)"+
                                "@foreach($product->inventory as $inventory)"+
                                "<option value='{{$product->id}}[{{$inventory->id}}]' data-product-quantity = '{{$inventory->quantity}}' data-product-selling-price = '{{$product->selling_price}}'>{{$product->name}} [{{$inventory->warehouse->name}}]</option>"+
                                "@endforeach"+
                                "@else"+
                                "<option value='{{$product->id}}' data-product-quantity = '-20' data-product-selling-price = '{{$product->selling_price}}'>{{$product->name}}</option>"+
                                "@endif"+
                                "@endforeach"+
                                "</select>";
        secondCell.innerHTML = "<input oninput = 'changeItemQuantity(this)' name='item_details["+tableValueArrayIndex+"][quantity]' type='number' class='form-control input-lg item-quantity' value = '0' min = '0'>";
        thirdCell.innerHTML = "<input oninput = 'changeItemRate(this)' name='item_details["+tableValueArrayIndex+"][rate]' type='number' class='form-control input-lg item-rate' placeholder='E.g +10, -10' value = '0' min = '0'>";
        fourthCell.innerHTML = "<input name='item_details[0][amount]' type='number' class='form-control input-lg item-total' placeholder='E.g +10, -10' value = '0' min = '0'>";
        fifthCell.innerHTML = "<span><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></span>";
        fifthCell.setAttribute("style", "width: 1em;");
        tableValueArrayIndex++;
    };
    function removeSelectedRow (e) {
        var selectedParentTd = e.parentElement.parentElement;
        var selectedTr = selectedParentTd.parentElement;
        var selectedTable = selectedTr.parentElement;
        var removed = selectedTr.getElementsByClassName("item-select")[0].getAttribute("name");
        adjustTableInputFieldsIndex(removed);
        selectedTable.removeChild(selectedTr);
        tableValueArrayIndex--;
        itemTotalChange();
    };
    function adjustTableInputFieldsIndex (removedFieldName) {
        // Fields whose values are submitted are:
        // 1. item_details[][item]
        // 2. item_details[][quantity]
        // 3. item_details[][rate]
        var displacement = 0;
        var removedIndex;
        while (displacement < tableValueArrayIndex) {
            if (removedFieldName == "item_details["+displacement+"][item]"){
                removedIndex = displacement;
            } else {
                var itemField = document.getElementsByName("item_details["+displacement+"][item]");
                var quantityField = document.getElementsByName("item_details["+displacement+"][quantity]");
                var rateField = document.getElementsByName("item_details["+displacement+"][rate]");
                if (removedIndex) {
                    if (displacement > removedIndex) {
                        var newIndex = displacement - 1;
                        itemField[0].setAttribute("name", "item_details["+newIndex+"][item]");
                        quantityField[0].setAttribute("name", "item_details["+newIndex+"][quantity]");
                        rateField[0].setAttribute("name", "item_details["+newIndex+"][rate]");
                    };
                };
            };
            displacement++;
        };
    };
    function itemTotalChange () {
        subTotal = [];
        var itemTotals = document.getElementsByClassName("item-total");
        for (singleTotal of itemTotals) {
            subTotal.push(Number(singleTotal.value));
        };
        var itemSubTotal = subTotal.reduce((a, b) => a + b, 0);
        document.getElementById("items-subtotal").value = itemSubTotal;
        document.getElementById("grand-total").innerHTML = itemSubTotal;
        var adjustedValueInputValue = document.getElementById("adjustment-value").value;
        if (adjustedValueInputValue.isEmpty) {
            adjustedValue = 0
        } else {
            adjustedValue = adjustedValueInputValue;
        };
        document.getElementById("adjustment-text").innerHTML = adjustedValue;
        var adjustedTotal = Number(adjustedValue) + Number(itemSubTotal);
        document.getElementById("grand-total").value = adjustedTotal;
    };
</script>
@endsection
