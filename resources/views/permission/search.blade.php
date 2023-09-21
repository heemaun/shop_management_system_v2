@foreach ($permissions as $permission)
    <tr data-href="{{ route('permissions.edit',$permission->id) }}" class="clickable">
        <td class="right">{{ $loop->iteration }}</td>
        <td>{{ $permission->name }}</td>
    </tr>
@endforeach