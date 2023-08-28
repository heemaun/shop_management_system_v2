@extends('default.index')
@section('content')
    <div class="user-show">
        <div class="infos">
            <h2>User Information</h2>

            <div class="info">
                <label for="status" >Status</label>
                <span class="data">{{ $user->status->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Username</label>
                <span class="data">{{ strtolower($user->username) }}</span>
            </div>

            <div class="info">
                <label for="status" >Name</label>
                <span class="data">{{ $user->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Gender</label>
                <span class="data">{{ $user->gender }}</span>
            </div>

            <div class="info">
                <label for="status" >Address</label>
                <span class="data">{{ $user->address }}</span>
            </div>

            <div class="info">
                <label for="status" >Date Of Birth</label>
                <span class="data">{{ date('d-M-Y', strtotime($user->dob)) }}</span>
            </div>

            <div class="info">
                <label for="status" >Email</label>
                <span class="data">{{ strtolower($user->email) }}</span>
            </div>

            <div class="info">
                <label for="status" >Phone</label>
                <span class="data">{{ $user->phone }}</span>
            </div>

            <div class="info">
                <label for="status" >Created At</label>
                <span class="data">{{ date('d-M-Y h:i:s A', strtotime($user->created_at)) }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified At</label>
                <span class="data">{{ date('d-M-Y h:i:s A', strtotime($user->updated_at)) }}</span>
            </div>

            <div class="btn-container">
                <a href="{{ route('users.index') }}" class="button shadow click-shadow gray">Back</a>
                <a href="{{ route('users.edit', $user->id) }}" class="button shadow click-shadow green">Edit</a>
                <button type="button" id="delete_trigger" class="button shadow click-shadow red">Delete</button>
            </div>
        </div>

        <div class="image">
            <img src="{{ asset('image/default_user.jpg') }}" alt="Default User">
        </div>
    </div>

    <div id="user_delete_div" class="user-delete">
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" id="delete_form">
            @csrf
            @method('DELETE')

            <legend>Delete User</legend>

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
                <button type="submit" class="button shadow click-shadow red">Delete</button>
                <button type="button" class="button shadow click-shadow gray" id="delete_form_close">Close</button>
            </div>
        </form>
    </div>

    @push('CSS')
        <link rel="stylesheet" href="{{ asset('css/user/show.css') }}">
    @endpush

    @push('JS')
        <script src="{{ asset('js/user/show.js') }}"></script>
        @if (Session::has('user_added'))
            <script>
                toastr.success("{!! Session::pull('user_added') !!}");
            </script>
        @endif

        @if (Session::has('user_updated'))
            <script>
                toastr.success("{!! Session::pull('user_updated') !!}");
            </script>
        @endif
    @endpush

@endsection
