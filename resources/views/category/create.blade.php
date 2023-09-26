@extends('default.index')
@section("content")
<div class="category-create">
    <form action="{{ route('categories.store') }}" method="POST" id="category_create_form">
        @csrf

        <legend>{{ (Auth::check()) ? 'Add New Category' : 'Category Registration' }}</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter category name" required autocomplete="off">
            <span id="name_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow danger" type="button">Clear All</button>
            
            <div>
                <button class="button shadow click-shadow primary" type="submit">Store</button>
                <a href="{{ (Auth::check()) ? route('categories.index') : route('home') }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/category/create.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/category/create.js') }}"></script>
@endpush

@endsection