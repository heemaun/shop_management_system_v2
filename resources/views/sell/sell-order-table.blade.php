<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Units</th>
            <th></th>
            <th>Sub-Total</th>
            <th>Discount</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sell->sellOrders as $so)
        <tr>
            <td>
                <button data-id="{{ $so->id }}" type="button" class="button shadow click-shadow danger delete">X</button>         
            </td>
            <td>{{ $loop->iteration.'.' }}</td>
            <td>{{ $so->product->name }}</td>
            <td class="right">{{ number_format($so->product->price,2) }}</td>
            <td class="right">{{ $so->units }}</td>
            <td>
                <button data-id="{{ $so->id }}" type="button" class="button shadow click-shadow success add">+</button>
                <button data-id="{{ $so->id }}" type="button" class="button shadow click-shadow warning sub">-</button>
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
            <td class="right">Total</td>
            <td class="right"><span id="sell_total">{{ number_format($sell->sub_total,2) }}</span></td>
        </tr>

        <tr>
            <td class="right">Discount</td>
            <td class="right"><input type="number" class="text-field right" value="{{ empty($sell->discount) ? 0 : $sell->discount }}" min="0" id="sell_discount"></td>
        </tr>

        <tr>
            <td class="right">Grand Total</td>
            <td class="right"><span id="sell_grand_total">{{ number_format($sell->sub_total - $sell->discount,2) }}</span></td>
        </tr>
    </tfoot>
</table>