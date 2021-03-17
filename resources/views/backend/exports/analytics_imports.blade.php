<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Total Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($imports as $key => $import)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$import->name}}</td>
            <td>{{$import->total_quantity}}</td>
            <td>${{number_format($import->total_price, 2)}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td>{{$imports->sum('total_quantity')}}</td>
        <td>${{number_format($imports->sum('total_price'), 2)}}</td>
    </tr>
    </tbody>
</table>
