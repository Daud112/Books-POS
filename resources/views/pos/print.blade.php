<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        @media print {
            @page {
                size: 80mm auto; /* Width suitable for receipt paper */
                margin: 5mm; /* Margin around the content */
            }

            body {
                margin: 0; /* Remove default margin */
                font-size: 10px; /* Adjust font size for smaller content */
                line-height: 1.2;
            }

            .print-container {
                width: 100%; /* Full width of the page */
                overflow: hidden; /* Prevent overflow */
            }

            .print-container * {
                visibility: visible;
            }

            .print-container .header, 
            .print-container .footer {
                display: none; /* Hide header and footer */
            }

            .print-container .row {
                display: flex;
                justify-content: space-between;
                margin-bottom: 2mm; /* Reduce spacing */
            }

            .print-container .col-4 {
                flex: 1;
                text-align: left;
            }

            .print-container .col-2 {
                flex: 1;
                text-align: right;
            }

            .print-container .border-bottom {
                border-bottom: 1px solid #000;
                margin-bottom: 2mm; /* Reduce bottom margin */
            }

            /* Handle content that is too large */
            .print-container {
                page-break-inside: avoid; /* Avoid page breaks inside container */
            }
        }
    </style>
</head>
<body>
    <div class="print-container my-5 text-center">
        <h1 class="my-3 fs-4">Mughal Book Depot</h1>
        <div class="address">
            <h2 class="fs-5">G-Block BRANCH</h2>
            <div>14-A, DHA PHASE 1, G-BLOCK, Lahore, Pakistan</div>
        </div>
        <p><span class="fw-bold">Receipt No. #</span>{{$sale[0]->id}}</p>
        <p><span class="fw-bold">Contact # :</span> 0321 4398875</p>
        <div class="border border-dark">
            <h5>Sale Receipt</h5>
        </div>

        @foreach ($sale as $sale)
            <div class="row mt-2">
                <div class="col-6 text-start">
                    <p><span class="fw-bold">Invoice #</span> {{$sale->id}}</p>
                    <p><span class="fw-bold">Invoice Date:</span> {{ $sale->sale_datetime }}</p>
                    {{-- <p><span class="fw-bold">Customer Name:</span> {{ $sale->customer->name }}</p>
                    <p><span class="fw-bold">Customer Phone:</span> {{ $sale->customer->phone }}</p> --}}
                </div>
                <div class="col-6 text-start">
                    {{-- <p><span class="fw-bold">Invoice #</span> {{$sale->id}}</p>
                    <p><span class="fw-bold">Invoice Date:</span> {{ $sale->sale_datetime }}</p> --}}
                    <p><span class="fw-bold">Customer Name:</span> {{ $sale->customer->name }}</p>
                    <p><span class="fw-bold">Customer Phone:</span> {{ $sale->customer->phone }}</p>
                </div>
            </div>

            <div class="row border border-dark">
                <div class="col-4 fw-bold">Item Name</div>
                <div class="col-2 fw-bold">Price</div>
                <div class="col-2 fw-bold">Qty</div>
                <div class="col-2 fw-bold">Disc</div>
                <div class="col-2 fw-bold">Amount</div>
            </div>
            @foreach ($sale->productSales as $product)
                <div class="row">
                    <div class="col-4">{{ $product->title }}</div>
                    <div class="col-2">{{ $product->sale_price }}</div>
                    <div class="col-2">{{ $product->quantity }}</div>
                    <div class="col-2">@if($product->disc > 0) {{$product->disc}} @endif</div>
                    <div class="col-2">{{($product->sale_price-$product->disc)*$product->quantity}}</div>
                </div>
            @endforeach
            <div class="row my-2 border border-dark">
                <div class="col-4"></div>
                <div class="col-2"></div>
                <div class="col-2">{{$saletotal['total_qty']}}</div>
                <div class="col-2">@if($product->disc > 0) {{$saletotal['total_disc']}} @endif</div>
                <div class="col-2">{{$saletotal['total_sale_price']}}</div>
            </div>

            <div class="row my-2">
                <div class="col-6 fw-bold">Net Amount:</div>
                <div class="col-6 fs-5">Rs. {{$saletotal['total_sale_price']}}</div> 
            </div>
            <hr>
            <p>Software Developed by: Daud Mushtaq</p>
            <p>Ph: 0316 4845501</p>
        @endforeach
    </div>
</body>
<script type="text/javascript">
    function printStatement() {
        window.print();
    }
    window.onload = printStatement;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
</html>
