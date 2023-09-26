@extends('default.index')
@section("content")
<div class="purchase-create">
    <form action="{{ route('purchases.store') }}" method="POST" id="purchase_create_form">
        @csrf

        <legend>{{ (Auth::check()) ? 'Add New Purchase' : 'Purchase Registration' }}</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter purchase name" required autocomplete="off">
            <span id="name_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="name" >Balance</label>
            <input type="text" name="balance" id="balance" class="text-field" placeholder="enter purchase balance" required autocomplete="off" value="0">
            <span id="balance_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow danger" type="button">Clear All</button>
            
            <div>
                <button class="button shadow click-shadow primary" type="submit">Store</button>
                <a href="{{ (Auth::check()) ? route('purchases.index') : route('home') }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/purchase/create.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/purchase/create.js') }}"></script>
@endpush

@endsection