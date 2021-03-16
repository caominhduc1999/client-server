<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $key => $product)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$product->name}}</td>
            <td>${{number_format($product->price, 2)}}</td>
            <td>{{$product->total_quantity}}</td>
            <td>${{number_format($product->total_price, 2)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
