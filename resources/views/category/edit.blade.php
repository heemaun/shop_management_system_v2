@extends('default.index')
@section("content")
<div class="category-edit">
    <form action="{{ route('categories.update',$category->id) }}" method="POST" id="category_edit_form">
        @csrf
        @method("PUT")

        <legend>Update Category</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter category name" required autocomplete="off" value="{{ $category->name }}">
            <span id="name_error" class="error"></span>
        </div>
        
        <div class="form-group">
            <label for="status_id" >Status</label>
            <select name="status_id" id="status_id" class="select" required>
                <option value="">Select a status</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ ($status->id == $category->status_id) ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
            <span id="gender_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow danger" type="button">Clear All</button>
            <div>
                <button class="button shadow click-shadow primary" type="submit">update</button>
                <a href="{{ route('categories.show',$category->id) }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/category/edit.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/category/edit.js') }}"></script>
@endpush

@endsection