@extends('default.index')
@section("content")
<div class="user-edit">
    <form action="{{ route('users.update',$user->id) }}" method="POST" id="user_edit_form">
        @csrf
        @method("PUT")

        <legend>Update User</legend>

        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} name" required autocomplete="off" value="{{ $user->name }}">
            <span id="name_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="name" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} username" required autocomplete="off" value="{{ $user->username }}">
            <span id="username_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} email" required autocomplete="off" value="{{ $user->email }}">
            <span id="email_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone</label>
            <input type="number" name="phone" id="phone" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} phone" required autocomplete="off" value="{{ $user->phone }}">
            <span id="phone_error" class="error"></span>
        </div>

        <div class="form-group column-2">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" placeholder="enter yous address" required autocomplete="off"> value="{{ $user->address }}"</textarea>
            <span id="address_error" class="error"></span>
        </div>        

        <div class="form-group column-3">
            <label for="dob" class="form-label">Date Of Birth</label>
            <input type="date" name="dob" id="dob" class="form-control" placeholder="enter {{ (Auth::check()) ? 'user' : 'your' }} date of birth" max="{{ date('Y-m-d',strtotime(date('Y-m-d') . '-18 years')) }}" required autocomplete="off" value="{{ $user->dob }}">
            <span id="dob_error" class="error"></span>
        </div>

        <div class="form-group column-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-select" required>
                <option value="">Select a gender</option>
                <option value="Male" {{ (strcmp($user->gender,'Male')==0)? 'selected' : '' }}>Male</option>
                <option value="Female" {{ (strcmp($user->gender,'Female')==0)? 'selected' : '' }}>Female</option>
                <option value="Other" {{ (strcmp($user->gender,'Other')==0)? 'selected' : '' }}>Other</option>
            </select>
            <span id="gender_error" class="error"></span>
        </div>
        
        <div class="form-group column-3">
            <label for="status_id" class="form-label">Status</label>
            <select name="status_id" id="status_id" class="form-select" required>
                <option value="">Select a status</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ ($status->id == $user->status_id) ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
            <span id="gender_error" class="error"></span>
        </div>

        <div class="btn-container">
            <button class="btn btn-danger" type="button">Clear All</button>
            <div>
                <button class="btn btn-primary" type="submit">update</button>
                <a href="{{ route('users.show',$user->id) }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/user/edit.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/user/edit.js') }}"></script>
@endpush

@endsection