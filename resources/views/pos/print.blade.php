<!DOCTYPE html>
<html>
<head>
    <title>Sales Print Page</title>
</head>
<body>
    <h1>Sales</h1>
    
    @foreach ($sale as $sale)
        <h2>Sale ID: {{ $sale->id }}</h2>
        <p>Status: {{ $sale->status }}</p>
        <p>Sale Date: {{ $sale->sale_datetime }}</p>
        <p>Customer: {{ $sale->customer->name }}</p>
        
        <h3>Products Sold:</h3>
        <ul>
            @foreach ($sale->productSales as $product)
                <li>
                    Product: {{ $product->title }}<br>
                    Quantity: {{ $product->quantity }}<br>
                    Sale Price: ${{ $product->sale_price }}<br>
                    Buy Price: ${{ $product->buy_price }}<br>
                </li>
            @endforeach
        </ul>
        <hr>
    @endforeach
</body>
</html>
