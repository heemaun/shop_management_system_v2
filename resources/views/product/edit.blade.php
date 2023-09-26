@extends('default.index')
@section("content")
<div class="product-edit">
    <form action="{{ route('products.update',$product->id) }}" method="POST" id="product_edit_form">
        @csrf
        @method("PUT")

        <legend>Update Product</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter product name" required autocomplete="off" value="{{ $product->name }}">
            <span id="name_error" class="error"></span>
        </div>

        <div class="form-group">           
            <label for="category_id" >Category</label>
            <select name="category_id" id="category_id" class="select" required>
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ ($category->id == $product->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <span id="category_id_error" class="error"></span>
        </div>       

        <div class="form-group column-3">
            <label for="price" >Price [Tk]</label>
            <input type="number" name="price" id="price" class="text-field" placeholder="enter product price" required autocomplete="off" value="{{ $product->price }}">
            <span id="price_error" class="error"></span>
        </div>

        <div class="form-group column-3">
            <label for="units" >Units</label>
            <input type="number" name="units" id="units" class="text-field" placeholder="enter product units" required autocomplete="off" value="{{ $product->units }}">
            <span id="units_error" class="error"></span>
        </div>
        
        <div class="form-group column-3">
            <label for="status_id" >Status</label>
            <select name="status_id" id="status_id" class="select" required>
                <option value="">Select a status</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ ($status->id == $product->status_id) ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
            <span id="status_id_error" class="error"></span>
        </div>          

        <div class="form-group column-2">
            <label for="details" >Details</label>
            <textarea name="details" id="details" class="text-field" placeholder="enter yous details" required autocomplete="off"> {{ $product->details }}</textarea>
            <span id="details_error" class="error"></span>
        </div> 

        <div class="button-container">
            <button class="button shadow click-shadow danger" type="button">Clear All</button>
            <div>
                <button class="button shadow click-shadow primary" type="submit">update</button>
                <a href="{{ route('products.show',$product->id) }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/product/edit.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/product/edit.js') }}"></script>
@endpush

@endsection