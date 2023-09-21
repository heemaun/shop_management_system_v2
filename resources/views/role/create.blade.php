@extends('default.index')
@section("content")
<div class="role-create">
    <form action="{{ route('roles.store') }}" method="POST" id="role_create_form">
        @csrf

        <legend>{{ (Auth::check()) ? 'Add New Role' : 'Role Registration' }}</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter {{ (Auth::check()) ? 'role' : 'your' }} name" required autocomplete="off">
            <span id="name_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow primary" type="submit">Store</button>
            <a href="{{ (Auth::check()) ? route('roles.index') : route('home') }}" class="button shadow click-shadow secondary">Back</a>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/role/create.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/role/create.js') }}"></script>
@endpush

@endsection