<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Permissions</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($roles as $role)
            <tr data-href="{{ route('roles.edit',$role->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td class="permissions">{{ $role->permissions->pluck('name') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $roles->links() }}