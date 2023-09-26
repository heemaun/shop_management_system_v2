@extends('default.index')
@section('content')
    <div class="sell-show">
        <div class="button-container">
            <a href="{{ route('sells.index') }}" class="button shadow click-shadow secondary">Back</a>
            @can('Sells Edit')
            <a href="{{ route('sells.edit', $sell->id) }}" class="button shadow click-shadow success">Edit</a>                    
            @endcan
            @can('Sells Delete')
            <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>                    
            @endcan
        </div>

        <div class="infos">
            <h2>Sell Information</h2>

            <div class="info">
                <label for="status" >Status</label>
                <span class="data">{{ $sell->status->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified By</label>
                <span class="data">{{ $sell->admin->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Name</label>
                <span class="data">{{ $sell->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Balance</label>
                <span class="data">{{ $sell->balance.' Tk' }}</span>
            </div>

            <div class="info">
                <label for="status" >Created At</label>
                <span class="data">{{ date('d-M-Y h:i:s A', strtotime($sell->created_at)) }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified At</label>
                <span class="data">{{ date('d-M-Y h:i:s A', strtotime($sell->updated_at)) }}</span>
            </div>
        </div>       
    </div>

    @can('Sells Delete')
    <div id="sell_delete_div" class="sell-delete">
        <form action="{{ route('sells.destroy', $sell->id) }}" method="POST" id="delete_form">
            @csrf
            @method('DELETE')

            <legend>Delete Sell</legend>

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
        <link rel="stylesheet" href="{{ asset('css/sell/show.css') }}">
    @endpush

    @push('JS')
        <script src="{{ asset('js/sell/show.js') }}"></script>
        @if (Session::has('sell_added'))
            <script>
                toastr.success("{!! Session::pull('sell_added') !!}");
            </script>
        @endif

        @if (Session::has('sell_updated'))
            <script>
                toastr.success("{!! Session::pull('sell_updated') !!}");
            </script>
        @endif
    @endpush

@endsection
