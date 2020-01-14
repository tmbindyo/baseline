<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nihusubu | Invoice Print</title>

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

</head>

<body class="white-bg">
<div class="wrapper wrapper-content p-xl">
    <div class="ibox-content p-xl">
        <div class="row">
            <div class="col-sm-6">
                <h5>From:</h5>
                <address>
                    <strong>{{$institution->name}}</strong><br>
                    106 Jorg Avenu, 600/10<br>
                    Chicago, VT 32456<br>
                    <abbr title="Phone">P:</abbr> {{$institution->phone_number}}
                </address>
            </div>

            <div class="col-sm-6 text-right">
                <h4>Invoice No.</h4>
                <h4 class="text-navy">{{$invoice->reference}}</h4>
                <span>To:</span>
                @if($invoice->contact->organization == null)
                    {{--  if not business  --}}
                    <address>
                        <strong>{{$invoice->contact->first_name}} {{$invoice->contact->last_name}}</strong><br>
                        112 Street Avenu, 1080<br>
                        Miami, CT 445611<br>
                        <abbr title="Phone">P:</abbr> {{$invoice->contact->phone_number}}
                    </address>

                @else
                    {{--  if business  --}}
                    <address>
                        <strong>{{$invoice->contact->name}}</strong><br>
                        112 Street Avenu, 1080<br>
                        Miami, CT 445611<br>
                        <abbr title="Phone">P:</abbr> {{$invoice->contact->organization->phone_number}}
                    </address>
                @endif
                <p>
                    <span><strong>Invoice Date:</strong> {{$invoice->date}} </span><br/>
                    <span><strong>Due Date:</strong> {{$invoice->due_date}}</span>
                </p>
            </div>
        </div>

        <div class="table-responsive m-t">
            <table class="table invoice-table">
                <thead>
                <tr>
                    <th>Item List</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->sale_products as $product)
                    <tr>
                        <td><div><strong>{{$product->product->name}}</strong></div>
                            <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->rate}}</td>
                        <td>{{$product->amount}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div><!-- /table-responsive -->

        <table class="table invoice-total">
            <tbody>
            <tr>
                <td><strong>Sub Total :</strong></td>
                <td>{{$invoice->subtotal}}</td>
            </tr>
            <tr>
                <td><strong>TAX :</strong></td>
                <td>{{$invoice->tax}}</td>
            </tr>
            <tr>
                <td><strong>Discount :</strong></td>
                <td>{{$invoice->discount}}</td>
            </tr>
            <tr>
                <td><strong>TOTAL :</strong></td>
                <td>{{$invoice->total}}</td>
            </tr>
            </tbody>
        </table>
        <div class="well m-t"><strong>Notes</strong>
            {{$invoice->customer_notes}}
        </div>

        <div class="well m-t"><strong>Terms and Conditions</strong>
            {{$invoice->terms_and_conditions}}
        </div>
    </div>

</div>

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>

<script type="text/javascript">
    window.print();
</script>

</body>

</html>
