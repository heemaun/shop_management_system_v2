@extends('default.index')
@section("content")
<div class="permission-edit">
    <form action="{{ route('permissions.update',$permission->id) }}" method="POST" id="permission_edit_form">
        @csrf
        @method("PUT")

        <legend>Update Permission</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter permission name" required autocomplete="off" value="{{ $permission->name }}">
            <span id="name_error" class="error"></span>
        </div>   

        <div class="button-container">
            <button class="button shadow click-shadow primary" type="submit">update</button>
            <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>
            <a href="{{ route('permissions.index') }}" class="button shadow click-shadow secondary">Back</a>
        </div>
    </form>
</div>

<div id="permission_delete_div" class="permission-delete">
    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" id="delete_form">
        @csrf
        @method('DELETE')

        <legend>Delete Permission</legend>

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
    <link rel="stylesheet" href="{{ asset('css/permission/edit.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/permission/edit.js') }}"></script>
@endpush

@endsection