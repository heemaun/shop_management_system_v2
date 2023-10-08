@if (count($sells) == 0)

<span class="no-data-found">No Data Found!</span>

@else

{{ $sells->links() }}

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Customer Name</th>
            <th>Status</th>
            <th>Units</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($sells as $sell)
            <tr data-href="{{ route('sells.show',$sell->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td class="date">{{ date('d-M-Y h:i:s a',strtotime($sell->created_at)) }}</td>
                <td>{{ $sell->customer->name }}</td>
                <td>{{ $sell->status->name }}</td>
                <td>{{ $sell->units }}</td>
                <td>{{ $sell->sub_total - $sell->discount }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="6">
                {{ $sells->total().' rows of data returned' }}
            </td>
        </tr>
    </tfoot>
</table>

{{ $sells->links() }}     

@endif