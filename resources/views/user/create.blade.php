@extends('default.index')
@section("content")
<div class="user-create">
    <form action="{{ route('users.store') }}" method="POST" id="user_create_form">
        @csrf

        <legend>{{ (Auth::check()) ? 'Add New User' : 'User Registration' }}</legend>

        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} name" required autocomplete="off">
            <span id="name_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="name" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} username" required autocomplete="off">
            <span id="username_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} email" required autocomplete="off">
            <span id="email_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone</label>
            <input type="number" name="phone" id="phone" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} phone" required autocomplete="off">
            <span id="phone_error" class="error"></span>
        </div>

        <div class="form-group column-2">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" placeholder="enter yous address" required autocomplete="off"></textarea>
            <span id="address_error" class="error"></span>
        </div>        

        <div class="form-group">
            <label for="dob" class="form-label">Date Of Birth</label>
            <input type="date" name="dob" id="dob" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} date of birth" max="{{ date('Y-m-d',strtotime(date('Y-m-d') . '-18 years')) }}" required autocomplete="off">
            <span id="dob_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-select" required>
                <option value="">Select a gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <span id="gender_error" class="error"></span>
        </div>  
        
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} password" required autocomplete="off">
            <span id="password_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} password again" required autocomplete="off">
            <span id="password_confirmation_error" class="error"></span>
        </div>

        <div class="btn-container">
            <button class="btn btn-danger" type="button">Clear All</button>
            <div>
                <button class="btn btn-primary" type="submit">Store</button>
                <a href="{{ (Auth::check()) ? route('users.index') : route('home') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/user/create.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/user/create.js') }}"></script>
@endpush

@endsection