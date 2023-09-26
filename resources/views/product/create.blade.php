@extends('default.index')
@section("content")
<div class="product-create">
    <form action="{{ route('products.store') }}" method="POST" id="product_create_form">
        @csrf

        <legend>{{ (Auth::check()) ? 'Add New Product' : 'Product Registration' }}</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter product name" required autocomplete="off">
            <span id="name_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="units" >Units</label>
            <input type="number" name="units" id="units" class="text-field" placeholder="enter product units" required autocomplete="off">
            <span id="units_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="price" >Price</label>
            <input type="number" name="price" id="price" class="text-field" placeholder="enter product price" required autocomplete="off">
            <span id="price_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="category_id" >Categories</label>
            <select name="category_id" id="category_id">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <span id="category_id_error" class="error"></span>
        </div>

        <div class="form-group column-2">
            <label for="details" >Details</label>
            <textarea name="details" id="details" class="text-field" placeholder="enter product details" required autocomplete="off"></textarea>
            <span id="details_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow danger" type="button">Clear All</button>
            
            <div>
                <button class="button shadow click-shadow primary" type="submit">Store</button>
                <a href="{{ (Auth::check()) ? route('products.index') : route('home') }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/product/create.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/product/create.js') }}"></script>
@endpush

@endsection