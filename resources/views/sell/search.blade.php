@if (count($sells) == 0)

<span class="no-data-found">No Data Found!</span>

@else

{{ $sells->links() }}

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Name</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($sells as $sell)
            <tr data-href="{{ route('sells.show',$sell->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td>{{ $sell->status->name }}</td>
                <td>{{ $sell->name }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3">
                {{ $sells->total().' rows of data returned' }}
            </td>
        </tr>
    </tfoot>
</table>

{{ $sells->links() }}   

@endif