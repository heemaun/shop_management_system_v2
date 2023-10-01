@extends('default.index')
@section('content')
    <div class="status-show">
        <div class="button-container">
            <a href="{{ route('statuses.index') }}" class="button shadow click-shadow secondary">Back</a>
            @can('Statuses Edit')
            <a href="{{ route('statuses.edit', $status->id) }}" class="button shadow click-shadow success">Edit</a>                    
            @endcan
            @can('Statuses Delete')
            <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>                    
            @endcan
        </div>

        <div class="infos">
            <h2>Status Information</h2>

            <div class="info">
                <label for="status" >Name</label>
                <span class="data">{{ $status->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Created At</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($status->created_at)) }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified At</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($status->updated_at)) }}</span>
            </div>
        </div>       
    </div>

    @can('Statuses Delete')
    <div id="status_delete_div" class="status-delete">
        <form action="{{ route('statuses.destroy', $status->id) }}" method="POST" id="delete_form">
            @csrf
            @method('DELETE')

            <legend>Delete Status</legend>

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
        <link rel="stylesheet" href="{{ asset('css/status/show.css') }}">
    @endpush

    @push('JS')
        <script src="{{ asset('js/status/show.js') }}"></script>
        @if (Session::has('status_added'))
            <script>
                toastr.success("{!! Session::pull('status_added') !!}");
            </script>
        @endif

        @if (Session::has('status_updated'))
            <script>
                toastr.success("{!! Session::pull('status_updated') !!}");
            </script>
        @endif
    @endpush

@endsection
