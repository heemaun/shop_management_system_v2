@extends('default.index')
@section('content')
<div class="permission-index">
    <h2>Permission Index</h2>

    <div class="controls">
        <div class="form-group stretch">
            <label for="search" >Search Permission By Name</label>
            <input type="text" id="search" name="search" placeholder="search permission by name" class="text-field">
        </div>

        <div class="form-group">
            <a href="{{ route('permissions.create') }}" class="button shadow click-shadow success">Create</a>
        </div>
    </div>

    <div class="table-container">
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
    </div>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/permission/index.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/permission/index.js') }}"></script>

    @if (Session::has('permission_deleted'))
        <script>
            toastr.success("{!! Session::pull('permission_deleted') !!}");
        </script>
    @endif
    @if (Session::has('permission_created'))
        <script>
            toastr.success("{!! Session::pull('permission_created') !!}");
        </script>
    @endif
    @if (Session::has('permission_updated'))
        <script>
            toastr.success("{!! Session::pull('permission_updated') !!}");
        </script>
    @endif
@endpush

@endsection
