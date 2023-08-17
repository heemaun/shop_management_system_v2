<div class="cart">
    <table class="table table-bordered table-striped">
        <thead>
            <th></th>
            <th>No.</th>
            <th>Name</th>
            <th>Price</th>
            <th>Units</th>
            <th></th>
            <th>Sub-Total</th>
            <th>Discount</th>
            <th>Total</th>
        </thead>

        <tbody>
            @foreach ($sell->sellOrders as $so)
                <tr>
                    <td>
                        <button data-id="{{ $so->id }}" class="btn btn-danger product-add">X</button>         
                    </td>
                    <td>{{ $loop->iteration.'.' }}</td>
                    <td>{{ $so->product->name }}</td>
                    <td>{{ $so->product->price }}</td>
                    <td>{{ $so->units }}</td>
                    <td>
                        <button data-id="{{ $so->id }}" class="btn btn-success product-add">+</button>
                        <button data-id="{{ $so->id }}" class="btn btn-warning product-sub">-</button>
                    </td>
                    <td>{{ $so->price }}</td>
                    <td>{{ $so->discount }}</td>
                    <td>{{ $so->price - $so->discount }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td>Order Count</td>
                <td>{{ count($sell->sellOrders) }}</td>
                <td>Unit Count</td>
                <td>{{ $sell->units }}</td>
                <td>Total</td>
                <td>{{ $sell->sub_total }}</td>
            </tr>

            <tr>
                <td>Discount</td>
                <td><input type="number"></td>
            </tr>

            <tr>
                <td>Grand Total</td>
                <td>{{ $sell->sub_total - $sell->discount }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="btn-container">
        <button class="btn btn-primary">Confirm</button>
        <button class="btn btn-secondary">Close</button>
        <button class="btn btn-danger">Clear All</button>
    </div>
</div>