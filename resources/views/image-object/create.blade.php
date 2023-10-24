@extends('default.index')
@section("content")
<div class="image-object-create">
    <form action="{{ route('image-objects.store') }}" method="POST" id="image_object_create_form" enctype="multipart/form-data">
        @csrf        

        <legend>
            @if (strcmp(Request::route()->getName(),'users.image')==0)
                {{ 'Upload User Display Picture' }}            
            @elseif (strcmp(Request::route()->getName(),'products.image')==0)
                {{ 'Add Product Image' }}
            @elseif (strcmp(Request::route()->getName(),'settings.image')==0)
                {{ 'Upload Image Form' }}
            @else
                {{ 'Image Object Create Form' }}
            @endif
        </legend>

        <div class="form-group">
            <label for="image_file">Select an image</label>

            <input type="file" accept="image/jpeg,image/png,image/gif,image/jpg" id="image_input" hidden>
            
            <img src="@if ((strcmp(Request::route()->getName(),'users.image')==0))
                        @if (count($user->imageObjects) != 0)
                            {{ asset('storage/'.$user->imageObjects[0]->url) }}
                        @else
                            {{ asset('image/default_user.jpg') }}
                        @endif
                        @elseif ((strcmp(Request::route()->getName(),'products.image')==0))
                            {{-- @if (count($product->imageObjects) != 0)
                                {{ asset('storage/'.$product->imageObjects[0]->url) }}
                            @else --}}
                                {{ asset('image/camera.png') }}
                            {{-- @endif --}}
                        @elseif ((strcmp(Request::route()->getName(),'settings.image')==0))
                        @endif"

                class="{{ (strcmp(Request::route()->getName(),'users.image')==0) ? 'profile-picture' : '' }}
                        {{ (strcmp(Request::route()->getName(),'settings.image')==0) ? 'settings-image' : '' }}
                        {{ (strcmp(Request::route()->getName(),'products.image')==0) ? 'product-image' : '' }}"
                
                data-id="{{ (strcmp(Request::route()->getName(),'users.image')==0) ? $user->id : '' }}
                        {{ (strcmp(Request::route()->getName(),'settings.image')==0) ? $setting->id : '' }}
                        {{ (strcmp(Request::route()->getName(),'products.image')==0) ? $product->id : '' }}
                        {{ (strcmp(Request::route()->getName(),'image-object.create')==0) ? 1 : '' }}"

                alt="Default User Profile Image" id="view_image">
            
            <span class="error" id="image_input_error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow primary" type="submit">Upload</button>
            @if (strcmp(Request::route()->getName(),'users.image')==0)
                <a href="{{ route('users.show',$user->id) }}" class="button shadow click-shadow secondary">Back</a>
            @elseif (strcmp(Request::route()->getName(),'products.image')==0)
                <a href="{{ route('products.show',$product->id) }}" class="button shadow click-shadow secondary">Back</a>
            @elseif (strcmp(Request::route()->getName(),'settings.image')==0)
                <a href="{{ route('settings.index') }}" class="button shadow click-shadow secondary">Back</a>
            @else
                <a href="{{ route('home') }}" class="button shadow click-shadow secondary">Back</a>
            @endif
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