@extends('default.index')
@section('content')
<div class="role-index">
    <h2>Role Index</h2>

    <div class="controls">
        <div class="form-group stretch">
            <label for="search" >Search Role By Name</label>
            <input type="text" id="search" name="search" placeholder="search role by name" class="text-field">
        </div>

        <div class="form-group">
            <a href="{{ route('roles.create') }}" class="button shadow click-shadow success">Create</a>
        </div>
    </div>

    <div class="table-container">
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
    </div>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/role/index.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/role/index.js') }}"></script>

    @if (Session::has('role_deleted'))
        <script>
            toastr.success("{!! Session::pull('role_deleted') !!}");
        </script>
    @endif
    @if (Session::has('role_created'))
        <script>
            toastr.success("{!! Session::pull('role_created') !!}");
        </script>
    @endif
    @if (Session::has('role_updated'))
        <script>
            toastr.success("{!! Session::pull('role_updated') !!}");
        </script>
    @endif
@endpush

@endsection
