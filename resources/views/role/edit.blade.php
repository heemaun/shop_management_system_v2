@extends('default.index')
@section("content")
<div class="role-edit">
    <form action="{{ route('roles.update',$role->id) }}" method="POST" id="role_edit_form">
        @csrf
        @method("PUT")

        <legend>Update Role</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter role name" required autocomplete="off" value="{{ $role->name }}">
            <span id="name_error" class="error"></span>
        </div>   

        <div class="permissions">
            <div class="form-group">
                <label for="all_permission_ul">Available Permissions</label>
                <ul id="all_permission_ul">
                    @foreach ($allPermissions as $permission)
                    @if (!in_array($permission->id,$commonPermissions) ? 'common' : '')
                    <li id="{{ $permission->id }}">{{ $permission->name }}</li>
                    @endif
                    @endforeach
                </ul>
            </div>
            
            <div class="form-group">
                <label for="granted_permission_ul">Granted Permissions</label>
                <ul id="granted_permission_ul">
                    @foreach ($grantedPermissions as $permission)
                        <li id="{{ $permission->id }}">{{ $permission->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow primary" type="submit">update</button>
            <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>
            <a href="{{ route('roles.index') }}" class="button shadow click-shadow secondary">Back</a>
        </div>
    </form>
</div>

<div id="role_delete_div" class="role-delete">
    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" id="delete_form">
        @csrf
        @method('DELETE')

        <legend>Delete Role</legend>

        <div class="form-group">
            <label for="password" >Enter Your Password</label>
            <input type="password" id="password" class="text-field" placeholder="enter your password"
                name="password">
            <span id="password_error" class="error"></span>
        </div>

        <div class="form-group">
            <input type="checkbox" id="permanent" class="">
            <label for="permanent" >Select it if you wanna delete it permanently</label>
        </div>

        <div class="btn-container">
            <button type="submit" class="button shadow click-shadow danger">Delete</button>
            <button type="button" class="button shadow click-shadow secondary" id="delete_form_close">Close</button>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/role/edit.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/role/edit.js') }}"></script>
@endpush

@endsection