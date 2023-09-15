@if (count($users) == 0)

<tr>
    <td class="no-data" colspan="6">No Data Found</td>
</tr>

@else

@foreach ($users as $user)
    <tr class="clickable" data-href="{{ route('users.show',$user->id) }}">
        <td class="right">{{ $loop->iteration }}</td>
        <td>{{ $user->status->name }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
    </tr>
@endforeach

@endif