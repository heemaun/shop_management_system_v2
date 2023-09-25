@extends('default.index')
@section('content')
<div class="user-index">
    <h2>User Index</h2>

    <div class="controls">
        <div class="form-group stretch">
            <label for="search" >Search User By Name</label>
            <input type="text" id="search" name="search" placeholder="search user by name, email, phone" class="text-field" onkeyup="search()">
        </div>

        <div class="form-group">
            <label for="Status_id" >Select A Status</label>
            <select id="status_id" name="status_id" onchange="search()">
                <option value="All">Select a option</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ ($status->id == getStatusID('Active')) ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="Role_id" >Select A Role</label>
            <select id="role_id" name="role_id" onchange="search()">
                <option value="All">Select a option</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="row_count">Item Count</label>
            <select id="row_count" name="row_count" onchange="search()">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
            </select>
        </div>

        @can('Users Create')            
        <div class="form-group">
            <a href="{{ route('users.create') }}" class="button shadow click-shadow success">Create</a>
        </div>
        @endcan

        <span id="controls_toggle" class="controls-toggle" title="Show Control Panel"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m480-320 160-160-160-160-56 56 64 64H320v80h168l-64 64 56 56Zm0 240q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></span>
    </div>

    <div class="table-container">
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
    </div>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/user/index.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/user/index.js') }}"></script>

    @if (Session::has('user_deleted'))
        <script>
            toastr.success("{!! Session::pull('user_deleted') !!}");
        </script>
    @endif
@endpush

@endsection
