@extends('default.index')
@section('content')
    <div class="purchase-show">
        <div class="button-container">
            <a href="{{ route('purchases.index') }}" class="button shadow click-shadow secondary">Back</a>
            @can('Purchases Edit')
            <a href="{{ route('purchases.edit', $purchase->id) }}" class="button shadow click-shadow success">Edit</a>                    
            @endcan
            @can('Purchases Delete')
            <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>                    
            @endcan
        </div>

        <div class="infos">
            <h2>Purchase Information</h2>

            <div class="info">
                <label for="status" >Status</label>
                <span class="data">{{ $purchase->status->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified By</label>
                <span class="data">{{ $purchase->admin->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Name</label>
                <span class="data">{{ $purchase->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Balance</label>
                <span class="data">{{ $purchase->balance.' Tk' }}</span>
            </div>

            <div class="info">
                <label for="status" >Created At</label>
                <span class="data">{{ date('d-M-Y h:i:s A', strtotime($purchase->created_at)) }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified At</label>
                <span class="data">{{ date('d-M-Y h:i:s A', strtotime($purchase->updated_at)) }}</span>
            </div>
        </div>       
    </div>

    @can('Purchases Delete')
    <div id="purchase_delete_div" class="purchase-delete">
        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" id="delete_form">
            @csrf
            @method('DELETE')

            <legend>Delete Purchase</legend>

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
        <link rel="stylesheet" href="{{ asset('css/purchase/show.css') }}">
    @endpush

    @push('JS')
        <script src="{{ asset('js/purchase/show.js') }}"></script>
        @if (Session::has('purchase_added'))
            <script>
                toastr.success("{!! Session::pull('purchase_added') !!}");
            </script>
        @endif

        @if (Session::has('purchase_updated'))
            <script>
                toastr.success("{!! Session::pull('purchase_updated') !!}");
            </script>
        @endif
    @endpush

@endsection
