@if (count($users) == 0)

<span class="no-data">No Data Found!</span>

@else

@foreach ($users as $user)
    <tr data-href="{{ route('users.show',$user->id) }}">
        <td class="right">{{ $loop->iteration }}</td>
        <td>{{ $user->status->name }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
    </tr>
@endforeach

@endif