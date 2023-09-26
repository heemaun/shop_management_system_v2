@extends('default.index')
@section("content")
<div class="sell-create">
    <form action="{{ route('sells.store') }}" method="POST" id="sell_create_form">
        @csrf

        <legend>{{ (Auth::check()) ? 'Add New Sell' : 'Sell Registration' }}</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter sell name" required autocomplete="off">
            <span id="name_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="name" >Balance</label>
            <input type="text" name="balance" id="balance" class="text-field" placeholder="enter sell balance" required autocomplete="off" value="0">
            <span id="balance_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow danger" type="button">Clear All</button>
            
            <div>
                <button class="button shadow click-shadow primary" type="submit">Store</button>
                <a href="{{ (Auth::check()) ? route('sells.index') : route('home') }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/sell/create.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/sell/create.js') }}"></script>
@endpush

@endsection