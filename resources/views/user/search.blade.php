@if (count($users) == 0)

<span>No Data Found!</span>

@else

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
</table>

{{ $users->links() }}

@endif