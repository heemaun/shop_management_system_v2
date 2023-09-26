@if (count($statuses) == 0)

<span class="no-data-found">No Data Found!</span>

@else

{{ $statuses->links() }}

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($statuses as $status)
            <tr data-href="{{ route('statuses.show',$status->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td>{{ $status->name }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3">
                {{ $statuses->total().' rows of data returned' }}
            </td>
        </tr>
    </tfoot>
</table>

{{ $statuses->links() }}   

@endif