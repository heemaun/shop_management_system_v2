@if (count($users) == 0)

<span class="no-data-found">No Data Found!</span>

@else

{{ $users->links() }}

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Role</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
            <tr data-href="{{ route('users.show',$user->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td>{{ $user->status->name }}</td>
                <td>
                    @foreach ($user->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="7">
                {{ $users->total().' rows of data returned' }}
            </td>
        </tr>
    </tfoot>
</table>

{{ $users->links() }}  

@endif