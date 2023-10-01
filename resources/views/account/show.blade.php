@extends('default.index')
@section('content')
    <div class="account-show">
        <div class="button-container">
            <a href="{{ route('accounts.index') }}" class="button shadow click-shadow secondary">Back</a>
            @can('Accounts Edit')
            <a href="{{ route('accounts.edit', $account->id) }}" class="button shadow click-shadow success">Edit</a>                    
            @endcan
            @can('Accounts Delete')
            <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>                    
            @endcan
        </div>

        <div class="infos">
            <h2>Account Information</h2>

            <div class="info">
                <label for="status" >Status</label>
                <span class="data">{{ $account->status->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified By</label>
                <span class="data">{{ $account->admin->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Name</label>
                <span class="data">{{ $account->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Balance</label>
                <span class="data">{{ $account->balance.' Tk' }}</span>
            </div>

            <div class="info">
                <label for="status" >Created At</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($account->created_at)) }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified At</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($account->updated_at)) }}</span>
            </div>
        </div>       
    </div>

    @can('Accounts Delete')
    <div id="account_delete_div" class="account-delete">
        <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" id="delete_form">
            @csrf
            @method('DELETE')

            <legend>Delete Account</legend>

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
        <link rel="stylesheet" href="{{ asset('css/account/show.css') }}">
    @endpush

    @push('JS')
        <script src="{{ asset('js/account/show.js') }}"></script>
        @if (Session::has('account_added'))
            <script>
                toastr.success("{!! Session::pull('account_added') !!}");
            </script>
        @endif

        @if (Session::has('account_updated'))
            <script>
                toastr.success("{!! Session::pull('account_updated') !!}");
            </script>
        @endif
    @endpush

@endsection
