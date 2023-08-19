<table class="table table-bordered table-striped">
    <thead>
        <th></th>
        <th>No.</th>
        <th>Name</th>
        <th>Price [Tk]</th>
        <th>Units</th>
        <th></th>
        <th>Sub-Total [Tk]</th>
        <th>Discount [Tk]</th>
        <th>Total [Tk]</th>
    </thead>

    <tbody>
        @foreach ($sell->sellOrders as $so)
            <tr>
                <td>
                    <button data-id="{{ $so->id }}" class="btn btn-danger product delete">X</button>         
                </td>
                <td>{{ $loop->iteration.'.' }}</td>
                <td>{{ $so->product->name }}</td>
                <td class="right">{{ number_format($so->product->price,2) }}</td>
                <td class="right">{{ $so->units }}</td>
                <td>
                    <button data-id="{{ $so->id }}" class="btn btn-success product add">+</button>
                    <button data-id="{{ $so->id }}" class="btn btn-warning product sub">-</button>
                </td>
                <td class="right">{{ number_format(($so->price * $so->units),2) }}</td>
                <td class="right">{{ number_format($so->discount,2) }}</td>
                <td class="right">{{ number_format($so->price * $so->units - $so->discount,2) }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="7" rowspan="3">
                Order Count: <span>{{ count($sell->sellOrders) }}</span>
                Unit Count: <span>{{ $sell->units }}</span>
            </td>
            <td>Total</td>
            <td class="right"><span>{{ number_format($sell->sub_total,2) }}</span></td>
        </tr>

        <tr>
            <td>Discount</td>
            <td><input type="number"></td>
        </tr>

        <tr>
            <td>Grand Total</td>
            <td class="right"><span>{{ number_format($sell->sub_total - $sell->discount,2) }}</span></td>
        </tr>
    </tfoot>
</table>