@extends('default.index')
@section("content")
<div class="image-object-create">
    <form action="{{ route('image-objects.store') }}" method="POST" id="image_object_create_form" enctype="multipart/form-data">
        @csrf        

        <div class="form-group">
            <label for="image_file">Select an image</label>
            <input type="file" accept="image/jpeg,image/png,image/gif,image/jpg" id="file" hidden>
            <img src="{{ asset('image/default_user.jpg') }}" alt="Default User Profile Image" id="view_image">
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow primary" type="submit">Upload</button>
            <a href="{{ route('home') }}" class="button shadow click-shadow secondary">Back</a>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/image-object/create.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/image-object/create.js') }}"></script>
@endpush

@endsection