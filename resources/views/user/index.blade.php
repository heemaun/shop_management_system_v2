@extends('default.index')
@section('content')
<div class="user-index">
    <h2>User Index</h2>

    <div class="controls">
        <div class="form-group stretch">
            <label for="search" >Search User By Name</label>
            <input type="text" id="search" name="search" placeholder="search user by name, email, phone" class="text-field">
        </div>

        <div class="form-group">
            <label for="Status" >Select A Status</label>
            <select name="status_id" id="status_id" class="select">
                <option value="All">Select a option</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <a href="{{ route('users.create') }}" class="button shadow click-shadow green">Create</a>
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Status</th>
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
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
