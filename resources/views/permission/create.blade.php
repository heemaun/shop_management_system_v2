@extends('default.index')
@section("content")
<div class="permission-create">
    <form action="{{ route('permissions.store') }}" method="POST" id="permission_create_form">
        @csrf

        <legend>{{ (Auth::check()) ? 'Add New Permission' : 'Permission Registration' }}</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter {{ (Auth::check()) ? 'permission' : 'your' }} name" required autocomplete="off">
            <span id="name_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow primary" type="submit">Store</button>
            <a href="{{ (Auth::check()) ? route('permissions.index') : route('home') }}" class="button shadow click-shadow secondary">Back</a>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/permission/create.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/permission/create.js') }}"></script>
@endpush

@endsection