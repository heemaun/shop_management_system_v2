@extends('default.index')
@section('content')
    <div class="user-show">
        <div class="button-container">
            <a href="{{ route('users.index') }}" class="button shadow click-shadow secondary">Back</a>
            @can('Users Edit')
            <a href="{{ route('users.edit', $user->id) }}" class="button shadow click-shadow success">Edit</a>                    
            @endcan
            @can('Users Delete')
            <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>                    
            @endcan
            <a href="{{ route('users.image',$user->id) }}" class="button primary shadow click-shadow">Upload</a>
        </div>

        <div class="image">
            <img id="image_viewer_trigger" src="{{ (count($user->imageObjects) != 0) ? asset('storage/'.$user->imageObjects[0]->url) : asset('image/default_user.jpg') }}" alt="Default User">
        </div>

        <div class="infos">
            <h2>User Information</h2>

            <div class="info">
                <label for="status" >Status</label>
                <span class="data">{{ $user->status->name }}</span>
            </div>
            
            <div class="info">
                <label for="status" >Role</label>
                <span class="data">{{ $user->roles[0]->name }}</span>
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
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($user->created_at)) }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified At</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($user->updated_at)) }}</span>
            </div>
        </div>       
    </div>

    @if (count($user->imageObjects) != 0)
    <div id="image_view_div" class="image-viewer image-viewer-hide">
        <span class="image-viewer-close" id="image_viewer_close_trigger"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></span>
        <img src="{{ asset('storage/'.$user->imageObjects[0]->url) }}" alt="User Display Image">
    </div>        
    @endif

    @can('Users Delete')
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

            <div class="button-container">
                <button type="submit" class="button shadow click-shadow danger">Delete</button>
                <button type="button" class="button shadow click-shadow secondary" id="delete_form_close">Close</button>
            </div>
        </form>
    </div>
    @endcan

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
