<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($permissions as $permission)
            <tr data-href="{{ route('permissions.edit',$permission->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td>{{ $permission->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $permissions->links() }}