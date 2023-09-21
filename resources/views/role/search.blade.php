@foreach ($roles as $role)
    <tr data-href="{{ route('roles.edit',$role->id) }}" class="clickable">
        <td class="right">{{ $loop->iteration }}</td>
        <td>{{ $role->name }}</td>
        <td>{{ $role->permissions->pluck('name') }}</td>
    </tr>
@endforeach