@if (count($purchases) == 0)

<span class="no-data-found">No Data Found!</span>

@else

{{ $purchases->links() }}

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Name</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($purchases as $purchase)
            <tr data-href="{{ route('purchases.show',$purchase->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td>{{ $purchase->status->name }}</td>
                <td>{{ $purchase->name }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3">
                {{ $purchases->total().' rows of data returned' }}
            </td>
        </tr>
    </tfoot>
</table>

{{ $purchases->links() }}   

@endif