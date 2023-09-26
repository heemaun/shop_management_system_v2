@if (count($accounts) == 0)

<span class="no-data-found">No Data Found!</span>

@else

{{ $accounts->links() }}

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Name</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($accounts as $account)
            <tr data-href="{{ route('accounts.show',$account->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td>{{ $account->status->name }}</td>
                <td>{{ $account->name }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3">
                {{ $accounts->total().' rows of data returned' }}
            </td>
        </tr>
    </tfoot>
</table>

{{ $accounts->links() }}   

@endif