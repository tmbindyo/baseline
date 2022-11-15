@extends('business.layouts.app')

@section('title', ' Expense Edit')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Expenses</h2>
            <ol class="breadcrumb">
                <li>
                    <strong><a href="{{route('business.calendar',$institution->portal)}}">Home</a></strong>
                </li>
                <li>
                    <a href="#">Accounting</a>
                </li>
                <li>
                    <strong><a href="{{route('business.expenses',$institution->portal)}}">Expenses</a></strong>
                </li>
                <li>
                    <strong><a href="{{route('business.expense.show',['portal'=>$institution->portal, 'id'=>$expense->id])}}">Expense</a></strong>
                </li>
                <li class="active">
                    <strong>Expense Edit</strong>
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
                            <form method="post" action="{{ route('business.expense.update',['portal'=>$institution->portal, 'id'=>$expense->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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


                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Customer  --}}
                                        <div class="has-warning">
                                            @if ($errors->has('category'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                            @endif
                                            <select name="category" class="select2_category form-control input-lg {{ $errors->has('category') ? ' is-invalid' : '' }}" required>
                                                <option selected value="{{$expense->category->id}}"> {{$expense->category->name}}</option>
                                            </select>
                                            <i>category</i>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <hr>
                                {{--table--}}
                                <div class="">
                                    <table class="table table-bordered" id = "expense_table">
                                        <thead>
                                        <tr>
                                            <th>Item Details</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Due Date</th>
                                            <th>Priority</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $product_index = 0
                                        @endphp
                                        @foreach($expense->categoryExpenseItems as $product)
                                            <tr>
                                                <td>
                                                    <input name="item_details[{{$product_index}}][item]" type="text" class="form-control input-lg item-detail" value="{{$product->name}}" @if($product->status_id == '0044ee5b-d3f8-4feb-a108-92e65b48e449') readonly @endif>
                                                </td>
                                                <td>
                                                    <input oninput = "changeItemQuantity(this)" name="item_details[{{$product_index}}][quantity]" type="number" class="form-control input-lg item-quantity" value = "{{$product->quantity}}" min = "0"  @if($product->status_id == '0044ee5b-d3f8-4feb-a108-92e65b48e449') readonly @endif>
                                                </td>
                                                <td>
                                                    <input oninput = "changeItemRate(this)" name="item_details[{{$product_index}}][rate]" type="number" class="form-control input-lg item-rate" placeholder="E.g +10, -10" value = "{{$product->rate}}" min = "0"  @if($product->status_id == '0044ee5b-d3f8-4feb-a108-92e65b48e449') readonly @endif>
                                                </td>
                                                <td>
                                                    <input oninput = "itemTotalChange()" onchange = "this.oninput()" name="item_details[{{$product_index}}][amount]" type="number" class="form-control input-lg item-total" placeholder="E.g +10, -10" value = "{{$product->amount}}" min = "0"  @if($product->status_id == '0044ee5b-d3f8-4feb-a108-92e65b48e449') readonly @endif>
                                                </td>

                                                <td>
                                                    <div class="has-warning" id="data_1">
                                                        <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                            <input type="text" name="item_details[{{$product_index}}][date]" id="item_date" value="{{$product->date}}" class="form-control input-lg {{ $errors->has('start_date') ? ' is-invalid' : '' }}"  @if($product->status_id == '0044ee5b-d3f8-4feb-a108-92e65b48e449') readonly @endif>
                                                        </div>
                                                        <i> date.</i>
                                                    </div>
                                                    {{-- <input type="text" name="item_details[0][item_date]" id="item_date" class="form-control input-lg" value="11/03/2022"> --}}
                                                </td>
                                                <td>
                                                    <div class="has-warning" id="data_1">
                                                        <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                            <input type="text" name="item_details[{{$product_index}}][due_date]" id="due_date" value="{{$product->due_date}}" class="form-control input-lg {{ $errors->has('start_date') ? ' is-invalid' : '' }}"  @if($product->status_id == '0044ee5b-d3f8-4feb-a108-92e65b48e449') readonly @endif>
                                                        </div>
                                                        <i> due date.</i>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="has-warning">
                                                        <select name="item_details[{{$product_index}}][priority]" class="select2_priorities form-control input-lg {{ $errors->has('item_details[0][priority]') ? ' is-invalid' : '' }}" required  @if($product->status_id == '0044ee5b-d3f8-4feb-a108-92e65b48e449') readonly @endif>
                                                            <option></option>
                                                            @foreach($priorities as $prioritiy)
                                                                <option @if ($prioritiy->id == $product->priority_id) selected @endif value="{{$prioritiy->id}}">{{$prioritiy->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <i>prioritiy</i>
                                                    </div>
                                                </td>

                                            </tr>
                                            @php
                                                $product_index++
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <label class="btn btn-small btn-primary" onclick = "addTableRow()">+ Add Another Line</label>
                                </div>

                                {{--sub totals--}}
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-8">
                                        <input name="subtotal" type = "number" class="pull-right input-lg form-control" id = "items-subtotal" readonly value="{{$expense->sub_total}}">
                                        <i>Sub Total</i>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-8">
                                        <input name="adjustment" oninput = "itemTotalChange()" type="number" class="form-control input-lg" id = "adjustment-value" value = "{{$expense->adjustment}}">
                                        <i>Adjustment</i>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-8">
                                        <input type = "number" name = "grand_total" id = "grand-total" class="pull-right input-lg form-control" value = "{{$expense->total}}" readonly>
                                        <i>Total</i>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-8">
                                        <input type = "number" name = "paid" id = "paid" class="pull-right input-lg form-control" value = "{{$expense->paid}}" readonly>
                                        <i>Paid</i>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-8">
                                        <input type = "number" name = "balance" id = "balance" class="pull-right input-lg form-control" value = "{{$expense->balance}}" readonly>
                                        <i>Balance</i>
                                    </div>
                                </div>
                                <hr>
                                {{--  Tie expense to something  --}}
                                <br>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="has-warning">
                                            @if ($errors->has('notes'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('notes') }}</strong>
                                                </span>
                                            @endif
                                            <textarea name="notes" placeholder="Notes" class="form-control" rows="7">{{$expense->notes}}</textarea>
                                            <i>notes</i>
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

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- JSKnob -->
    <script src="{{ asset('inspinia') }}/js/plugins/jsKnob/jquery.knob.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <!-- Data picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- NouSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/nouslider/jquery.nouislider.min.js"></script>

    <!-- Switchery -->
    <script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="{{ asset('inspinia') }}/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="{{ asset('inspinia') }}/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->

    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="{{ asset('inspinia') }}/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <script>
        $(document).ready(function(){


            $(".select2_account").select2({
                placeholder: "Select Account",
                allowClear: true
            });
            $(".select2_campaign").select2({
                placeholder: "Select Campaign",
                allowClear: true
            });
            $(".select2_payment_schedule").select2({
                placeholder: "Select Payment Schedule",
                allowClear: true
            });
            $(".select2_expense_account").select2({
                placeholder: "Select Expense Account",
                allowClear: true
            });
            $(".select2_frequency").select2({
                placeholder: "Select Frequency",
                allowClear: true
            });
            $(".select2_sale").select2({
                placeholder: "Select Sale",
                allowClear: true
            });
            $(".select2_status").select2({
                placeholder: "Select Status",
                allowClear: true
            });
            $(".select2_transfer").select2({
                placeholder: "Select Transfer",
                allowClear: true
            });


            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });



        });

    </script>

    {{-- to do start time and end time --}}
    <script>
        $(document).ready(function() {
            $('.enableRecurring').on('click',function(){

                if (document.getElementById('is_recurring').checked) {
                    // enable end_time input
                    document.getElementById("frequency").disabled = false;
                    document.getElementById("start_date").disabled = false;
                    document.getElementById("end_date").disabled = false;
                } else {
                    // disable input
                    document.getElementById("frequency").disabled = true;
                    document.getElementById("start_date").disabled = true;
                    document.getElementById("end_date").disabled = true;
                }
            });
            $('.enableSale').on('click',function(){
                if (document.getElementById('is_sale').checked) {
                    // enable end_time input
                    document.getElementById("sale").disabled = false;
                } else {
                    // disable input
                    document.getElementById("sale").disabled = true;
                }
            });
            $('.enableTransfer').on('click',function(){

                if (document.getElementById('is_transfer').checked) {
                    // enable end_time input
                    document.getElementById("transfer").disabled = false;
                } else {
                    // disable input
                    document.getElementById("transfer").disabled = true;
                }
            });
            $('.enableCampaign').on('click',function(){

                if (document.getElementById('is_campaign').checked) {
                    // enable end_time input
                    document.getElementById("campaign").disabled = false;
                } else {
                    // disable input
                    document.getElementById("campaign").disabled = true;
                }
            });

        });

    </script>

    <script>
        $(document).ready(function() {

            var today = new Date();
            var start_date_dd = today.getDate();
            var start_date_mm = today.getMonth();
            var start_date_yyyy = today.getFullYear();
            start_date_mm ++;
            if (start_date_dd < 10){
                start_date_dd = '0'+start_date_dd;
            }
            if (start_date_mm < 10){
                start_date_mm = '0'+start_date_mm;
            }
            var date_today = start_date_mm + '/' + start_date_dd + '/' + start_date_yyyy;

            // expense date
            var expense_date_value = "<?php echo $expense->date ?>";
            // expense date
            var expense_date_transform = new Date(expense_date_value);
            var expense_dd = expense_date_transform.getDate();
            var expense_mm = expense_date_transform.getMonth();
            var expense_yyyy = expense_date_transform.getFullYear();
            expense_mm ++;
            if (expense_dd < 10){
                expense_dd = '0'+expense_dd;
            }
            if (expense_mm < 10){
                expense_mm = '0'+expense_mm;
            }
            var expense_date = expense_mm + '/' + expense_dd + '/' + expense_yyyy;
            document.getElementById("date").value = expense_date;

            // start repeat
            var start_repeat_exists = "<?php echo $expense->start_repeat ?>";
            // check if its set
            if(start_repeat_exists){
                // expense date
                var start_repeat_date = new Date(start_repeat_exists);
                var start_repeat_dd = start_repeat_date.getDate();
                var start_repeat_mm = start_repeat_date.getMonth();
                var start_repeat_yyyy = start_repeat_date.getFullYear();
                start_repeat_mm ++;
                if (start_repeat_dd < 10){
                    start_repeat_dd = '0'+start_repeat_dd;
                }
                if (start_repeat_mm < 10){
                    start_repeat_mm = '0'+start_repeat_mm;
                }
                var start_repeat_final = start_repeat_mm + '/' + start_repeat_dd + '/' + start_repeat_yyyy;
                document.getElementById("start_date").value = start_repeat_final;

            }else {

                document.getElementById("start_date").value = date_today;
            }
            // end repeat
            var end_repeat_exists = "<?php echo $expense->end_repeat ?>";
            if(end_repeat_exists){
                console.log(end_repeat_exists)
                // expense date
                var end_repeat_date = new Date(end_repeat_exists);
                var end_repeat_dd = end_repeat_date.getDate();
                var end_repeat_mm = end_repeat_date.getMonth();
                var end_repeat_yyyy = end_repeat_date.getFullYear();
                end_repeat_mm ++;
                if (end_repeat_dd < 10){
                    end_repeat_dd = '0'+end_repeat_dd;
                }
                if (end_repeat_mm < 10){
                    end_repeat_mm = '0'+end_repeat_mm;
                }
                var end_repeat_final = end_repeat_mm + '/' + end_repeat_dd + '/' + end_repeat_yyyy;
                document.getElementById("end_date").value = end_repeat_final;

            }else {
                document.getElementById("end_date").value = date_today;
            }



            // Set time
        });

    </script>

    <script>
        var subTotal = [];
        var adjustedValue;
        function itemSelected (e) {
            var selectedItemQuantity = e.options[e.selectedIndex].getAttribute("data-product-quantity");
            var selectItemPrice = e.options[e.selectedIndex].getAttribute("data-product-selling-price");
            var selectedParentTd = e.parentElement;
            var selectedTr = selectedParentTd.parentElement;
            var itemQuantity = selectedTr.getElementsByClassName("item-quantity");
            var itemRate = selectedTr.getElementsByClassName("item-rate");
            // -20 is an arbitrary value set to indicate that an item is a service and so has no limit
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
            var table = document.getElementById("expense_table");

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth();
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            mm ++;
            if (dd < 10){
                dd = '0'+dd;
            }
            if (mm < 10){
                mm = '0'+mm;
            }
            var date_today = mm + '/' + dd + '/' + yyyy;

            var row = table.insertRow();
            var firstCell = row.insertCell(0);
            var secondCell = row.insertCell(1);
            var thirdCell = row.insertCell(2);
            var fourthCell = row.insertCell(3);
            var fifthCell = row.insertCell(4);
            var sixthCell = row.insertCell(5);
            var seventhCell = row.insertCell(6);
            var eigthCell = row.insertCell(7);

            firstCell.innerHTML = "<input name='item_details["+tableValueArrayIndex+"][item]' type='text' class='form-control input-lg item-detail'>";
            secondCell.innerHTML = "<input oninput = 'changeItemQuantity(this)' name='item_details["+tableValueArrayIndex+"][quantity]' type='number' class='form-control input-lg item-quantity' value = '0' min = '0'>";
            thirdCell.innerHTML = "<input oninput = 'changeItemRate(this)' name='item_details["+tableValueArrayIndex+"][rate]' type='number' class='form-control input-lg item-rate' placeholder='E.g +10, -10' value = '0' min = '0'>";
            fourthCell.innerHTML = "<input name='item_details["+tableValueArrayIndex+"][amount]' type='number' class='form-control input-lg item-total' placeholder='E.g +10, -10' value = '0' min = '0'>";

            fifthCell.innerHTML = "<div class='has-warning' id='data_1'> <div class='input-group date'> <span class='input-group-addon'> <i class='fa fa-calendar'></i> </span> <input type='text' name='item_details["+tableValueArrayIndex+"][date]' value="+date_today+" id='date' class='form-control input-lg'> </div> <i> date.</i> </div>";
            sixthCell.innerHTML = "<div class='has-warning' id='data_1'> <div class='input-group date'> <span class='input-group-addon'> <i class='fa fa-calendar'></i> </span> <input type='text' name='item_details["+tableValueArrayIndex+"][due_date]' value="+date_today+" id='due_date' class='form-control input-lg'> </div> <i> due date.</i> </div>";

            seventhCell.innerHTML = "<td> <div class='has-warning'> <select name='item_details["+tableValueArrayIndex+"][priority]' id='priority' class='select2_priorities form-control input-lg' required> <option></option> @foreach($priorities as $prioritiy) <option value='{{$prioritiy->id}}'>{{$prioritiy->name}}</option> @endforeach </select> <i>prioritiy</i> </div> </td>";


            eigthCell.innerHTML = "<span><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></span>";
            eigthCell.setAttribute("style", "width: 1em;")
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
            // 4. item_details[][amount]
            var displacement = 0;
            var removedIndex;
            while (displacement < tableValueArrayIndex) {
                if (removedFieldName == "item_details["+displacement+"][item]"){
                    removedIndex = displacement;
                } else {
                    var itemField = document.getElementsByName("item_details["+displacement+"][item]");
                    var quantityField = document.getElementsByName("item_details["+displacement+"][quantity]");
                    var rateField = document.getElementsByName("item_details["+displacement+"][rate]");
                    var amountField = document.getElementsByName("item_details["+displacement+"][amount]");
                    if (removedIndex) {
                        if (displacement > removedIndex) {
                            var newIndex = displacement - 1;
                            itemField[0].setAttribute("name", "item_details["+newIndex+"][item]");
                            quantityField[0].setAttribute("name", "item_details["+newIndex+"][quantity]");
                            rateField[0].setAttribute("name", "item_details["+newIndex+"][rate]");
                            amountField[0].setAttribute("name", "item_details["+newIndex+"][amount]");
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
            document.getElementById("adjustment-value").innerHTML = adjustedValue;
            var adjustedTotal = Number(adjustedValue) + Number(itemSubTotal);
            document.getElementById("grand-total").value = adjustedTotal;
        };
    </script>
@endsection
