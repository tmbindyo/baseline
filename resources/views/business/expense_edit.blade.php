@extends('business.layouts.app')

@section('title', ' Expense Edit')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Expenses</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    <a href="{{route('business.expenses',$institution->portal)}}">Expenses</a>
                </li>
                <li>
                    <a href="{{route('business.expense.show',['portal'=>$institution->portal, 'id'=>$expense->id])}}">Expense</a>
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
                                        {{--  expense account  --}}
                                        <div class="has-warning">
                                            @if ($errors->has('expense_account'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('expense_account') }}</strong>
                                            </span>
                                            @endif
                                            <select name="expense_account" class="select2_account form-control input-lg {{ $errors->has('expense_account') ? ' is-invalid' : '' }}">
                                                @foreach($expenseAccounts as $expenseAccount)
                                                    <option @if($expenseAccount->id == $expense->expense_account_id) selected @endif value="{{$expenseAccount->id}}">{{$expenseAccount->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="has-warning" id="data_1">
                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                            @endif
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input type="text" name="date" value="{{$expense->date}}" id="date" class="form-control input-lg {{ $errors->has('date') ? ' is-invalid' : '' }}" required>
                                            </div>
                                            <i> expense date.</i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  expense account  --}}
                                        <div class="has-warning">
                                            @if ($errors->has('account'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('account') }}</strong>
                                            </span>
                                            @endif
                                            <select name="account" class="select2_account form-control input-lg {{ $errors->has('account') ? ' is-invalid' : '' }}" required>
                                                <option></option>
                                                @foreach($accounts as $account)
                                                    <option @if($expense->account_id == $account->id) selected @endif value="{{$account->id}}">{{$account->name}} [{{$account->balance}}]</option>
                                                @endforeach
                                            </select>
                                            <i>account</i>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        @if ($errors->has('is_paid'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('is_paid') }}</strong>
                                            </span>
                                        @endif
                                        <div class="checkbox checkbox-info">
                                            <input id="is_paid" name="is_paid" type="checkbox" @if($expense->is_paid == True) checked @endif checked class="{{ $errors->has('is_paid') ? ' is-invalid' : '' }}">
                                            <label for="is_paid">
                                                Paid
                                            </label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="If checked, the selected account is deducted from the selected account." class="fa fa-2x fa-question-circle"></i></span>
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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $product_index = 0
                                        @endphp
                                        @foreach($expense->expenseItems as $product)
                                            <tr>
                                                <td>
                                                    <input name="item_details[0][item]" type="text" class="form-control input-lg item-detail" value="{{$product->name}}">
                                                </td>
                                                <td>
                                                    <input oninput = "changeItemQuantity(this)" name="item_details[0][quantity]" type="number" class="form-control input-lg item-quantity" value = "{{$product->quantity}}" min = "0">
                                                </td>
                                                <td>
                                                    <input oninput = "changeItemRate(this)" name="item_details[0][rate]" type="number" class="form-control input-lg item-rate" placeholder="E.g +10, -10" value = "{{$product->rate}}" min = "0">
                                                </td>
                                                <td>
                                                    <input oninput = "itemTotalChange()" onchange = "this.oninput()" name="item_details[0][amount]" type="number" class="form-control input-lg item-total" placeholder="E.g +10, -10" value = "{{$product->amount}}" min = "0">
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
                                    <div class="row">
                                        <div class="col-md-3 col-md-offset-5">
                                            <label>Sub Total</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="subtotal" type = "number" class="pull-right input-lg form-control" id = "items-subtotal" readonly value="{{$expense->sub_total}}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2  col-md-offset-5">
                                            <label>Adjustment</label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="Add any other +ve or -ve charges that need to be applied to adjust the total amount of the transaction." class="fa fa-2x fa-question-circle"></i></span>
                                        </div>
                                        <div class="col-md-2 col-md-offset-1">
                                            <input name="adjustment" oninput = "itemTotalChange()" type="number" class="form-control input-lg" id = "adjustment-value" value = "{{$expense->adjustment}}">
                                        </div>
                                        <div class="col-md-1">
                                            <p class="pull-right" id = "adjustment-text">{{$expense->adjustment}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3 col-md-offset-5">
                                            <p>Total</p>
                                        </div>
                                        <div class="col-md-3">
                                            <input type = "number" name = "grand_total" id = "grand-total" class="pull-right input-lg form-control" value = "{{$expense->total}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                {{--  Tie expense to something  --}}
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            @if ($errors->has('sale'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('sale') }}</strong>
                                            </span>
                                            @endif
                                            <div class="col-md-4">
                                                {{--  Customer  --}}
                                                <div class="checkbox checkbox-info">
                                                    <input id="is_sale" name="is_sale" type="checkbox" @if($expense->is_sale == 1) checked @endif>
                                                    <label for="is_sale">
                                                        Sale
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="has-warning">
                                                    <div class="has-warning">
                                                        <select name="sale" class="select2_sale form-control input-lg {{ $errors->has('sale') ? ' is-invalid' : '' }}">
                                                            @if($expense->is_sale == 0)
                                                                <option></option>
                                                            @endif
                                                        @foreach($sales as $sale)
                                                                <option @if($sale->id == $expense->sale_id) selected @endif value="{{$sale->id}}" >{{$sale->sale_number}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="row">
                                            @if ($errors->has('liability'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('liability') }}</strong>
                                            </span>
                                            @endif
                                            <div class="col-md-4">
                                                {{--  Customer  --}}
                                                <div class="checkbox checkbox-info">
                                                    <input id="is_liability" name="is_liability" type="checkbox" @if($expense->is_liability == 1) checked @endif class="{{ $errors->has('is_liability') ? ' is-invalid' : '' }}">
                                                    <label for="is_liability">
                                                        Liability
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="has-warning">
                                                    <div class="has-warning">
                                                        <select name="liability" class="select2_liability form-control input-lg {{ $errors->has('liability') ? ' is-invalid' : '' }}">
                                                            <option></option>
                                                            @foreach($liabilities as $liability)
                                                                <option @if($liability->id == $expense->liability_id) selected @endif value="{{$liability->id}}" >{{$liability->reference}} [{{$liability->amount}}] ({{$liability->date}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            @if ($errors->has('transfer'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('transfer') }}</strong>
                                            </span>
                                            @endif
                                            <div class="col-md-4">
                                                {{--  Customer  --}}
                                                <div class="checkbox checkbox-info">
                                                    <input id="is_transfer" name="is_transfer" type="checkbox" @if($expense->is_transfer == 1) checked @endif class="{{ $errors->has('is_transfer') ? ' is-invalid' : '' }}">
                                                    <label for="is_transfer">
                                                        Transfer
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="has-warning">
                                                    <div class="has-warning">
                                                        <select name="transfer" class="select2_transfer form-control input-lg {{ $errors->has('transfer') ? ' is-invalid' : '' }}">
                                                            <option></option>
                                                            @foreach($transfers as $transfer)
                                                                <option @if($transfer->id == $expense->transfer_id) selected @endif value="{{$transfer->id}}" >{{$transfer->reference}} [{{$transfer->amount}}] ({{$transfer->date}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            @if ($errors->has('campaign'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('campaign') }}</strong>
                                            </span>
                                            @endif
                                            <div class="col-md-4">
                                                {{--  Customer  --}}
                                                <div class="checkbox checkbox-info">
                                                    <input id="is_campaign" name="is_campaign" type="checkbox" @if($expense->is_campaign == 1) checked @endif class="{{ $errors->has('is_campaign') ? ' is-invalid' : '' }}">
                                                    <label for="is_campaign">
                                                        Campaign
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="has-warning">
                                                    <div class="has-warning">
                                                        <select name="campaign" class="select2_campaign form-control input-lg" {{ $errors->has('campaign') ? ' is-invalid' : '' }}>
                                                            <option></option>
                                                            @foreach($campaigns as $campaign)
                                                                <option @if($campaign->id == $expense->campaign_id) selected @endif value="{{$campaign->id}}" >{{$campaign->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>


                                {{--attachments--}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            @if ($errors->has('recurring'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('recurring') }}</strong>
                                            </span>
                                            @endif
                                            <div class="col-md-4">
                                                <div class="checkbox checkbox-info">
                                                    <input id="is_recurring" name="is_recurring" type="checkbox" @if($expense->is_recurring == 1) checked @endif class="{{ $errors->has('is_recurring') ? ' is-invalid' : '' }}">
                                                    <label for="is_recurring">
                                                        Recurring
                                                    </label>
                                                    <span><i data-toggle="tooltip" data-placement="right" title="Check this option if you want to save this as a draft for further editing." class="fa fa-2x fa-question-circle"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="has-warning">
                                                    <select name="frequency" class="select2_frequency form-control input-lg"> {{ $errors->has('frequency') ? ' is-invalid' : '' }}
                                                        @if($expense->is_frequency == 0)
                                                            <option></option>
                                                        @endif
                                                        @foreach($frequencies as $frequency)
                                                            <option @if($frequency->id == $expense->frequency_id) selected @endif value="{{$frequency->id}}" >{{$frequency->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if ($errors->has('start_date'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('start_date') }}</strong>
                                                </span>
                                                @endif
                                                <div class="has-warning" id="data_1">
                                                    <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        <input type="text" name="start_date" id="start_date" class="form-control input-lg {{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{$expense->start_repeat}}" required>
                                                    </div>
                                                    <i> start date.</i>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @if ($errors->has('end_date'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('end_date') }}</strong>
                                                    </span>
                                                @endif
                                                <div class="has-warning" id="data_1">
                                                    <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        <input type="text" name="end_date" id="end_date" class="form-control input-lg {{ $errors->has('end_date') ? ' is-invalid' : '' }}" value="{{$expense->end_repeat}}">
                                                    </div>
                                                    <i> end date (leave blank if no end date)</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{--  Customer  --}}
                                        <div class="has-warning">
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                            <select name="status" class="select2_status form-control input-lg {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                <option></option>
                                                @foreach($expenseStatuses as $status)
                                                    <option @if($status->id == $expense->status_id) selected @endif value="{{$status->id}}" >{{$status->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{--  Customer  --}}
                                        <div class="checkbox checkbox-info">
                                            <input id="is_draft" name="is_draft" type="checkbox" @if($expense->is_draft == 1) checked @endif class="{{ $errors->has('is_draft') ? ' is-invalid' : '' }}">
                                            <label for="is_draft">
                                                Save As Draft
                                            </label>
                                            <span><i data-toggle="tooltip" data-placement="right" title="Check this option if you want to save this as a draft for further editing." class="fa fa-2x fa-question-circle"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="has-warning">
                                            @if ($errors->has('notes'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('notes') }}</strong>
                                                </span>
                                            @endif
                                            <textarea name="notes" placeholder="Notes" class="form-control" rows="7">{{$expense->notes}}</textarea>
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
            $(".select2_expense_account").select2({
                placeholder: "Select Expense Account",
                allowClear: true
            });
            $(".select2_frequency").select2({
                placeholder: "Select Frequency",
                allowClear: true
            });
            $(".select2_liability").select2({
                placeholder: "Select Liability",
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


    {{--  Get due date to populate   --}}
    <script>
        $(document).ready(function() {
            // Set date
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth();
            var yyyy = today.getFullYear();
            if (dd < 10){
                dd = '0'+dd;
            }
            if (mm < 10){
                mm = '0'+mm;
            }
            var date_today = mm + '/' + dd + '/' + yyyy;
            document.getElementById("due_date").value = date_today;
            document.getElementById("date").value = date_today;
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
            var row = table.insertRow();
            var firstCell = row.insertCell(0);
            var secondCell = row.insertCell(1);
            var thirdCell = row.insertCell(2);
            var fourthCell = row.insertCell(3);
            var fifthCell = row.insertCell(4);
            firstCell.innerHTML = "<input name='item_details["+tableValueArrayIndex+"][item]' type='text' class='form-control input-lg item-detail'>";
            secondCell.innerHTML = "<input oninput = 'changeItemQuantity(this)' name='item_details["+tableValueArrayIndex+"][quantity]' type='number' class='form-control input-lg item-quantity' value = '0' min = '0'>";
            thirdCell.innerHTML = "<input oninput = 'changeItemRate(this)' name='item_details["+tableValueArrayIndex+"][rate]' type='number' class='form-control input-lg item-rate' placeholder='E.g +10, -10' value = '0' min = '0'>";
            fourthCell.innerHTML = "<input name='item_details["+tableValueArrayIndex+"][amount]' type='number' class='form-control input-lg item-total' placeholder='E.g +10, -10' value = '0' min = '0'>";
            fifthCell.innerHTML = "<span><i onclick = 'removeSelectedRow(this)' class = 'fa fa-minus-circle btn btn-danger'></i></span>";
            fifthCell.setAttribute("style", "width: 1em;")
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
            document.getElementById("adjustment-text").innerHTML = adjustedValue;
            var adjustedTotal = Number(adjustedValue) + Number(itemSubTotal);
            document.getElementById("grand-total").value = adjustedTotal;
        };
    </script>
@endsection
