@extends('default.index')
@section('content')
    <div class="product-show">
        <div class="button-container">
            <a href="{{ route('products.index') }}" class="button shadow click-shadow secondary">Back</a>
            @can('Products Edit')
            <a href="{{ route('products.edit', $product->id) }}" class="button shadow click-shadow success">Edit</a>                    
            @endcan
            @can('Products Delete')
            <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>                    
            @endcan
            <a href="{{ route('products.image',$product->id) }}" class="button primary shadow click-shadow">Upload</a>
        </div>

        <div class="image">
            <img id="image_viewer_trigger" src="{{ (count($product->imageObjects) != 0) ? asset('storage/'.$product->imageObjects[0]->url) : asset('image/default_product.jpg') }}" alt="Default Product Image">
        </div>

        <div class="infos">
            <h2>Product Information</h2>

            <div class="info">
                <label for="status" >Status</label>
                <span class="data">{{ $product->status->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified By</label>
                <span class="data">{{ $product->admin->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Category</label>
                <span class="data">{{ $product->category->name }}</span>
            </div>            

            <div class="info">
                <label for="status" >Name</label>
                <span class="data">{{ $product->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Units</label>
                <span class="data">{{ $product->units }}</span>
            </div>

            <div class="info">
                <label for="status" >Price</label>
                <span class="data">{{ $product->price.' Tk' }}</span>
            </div>

            <div class="info">
                <label for="status" >Details</label>
                <span class="data">{{ $product->details }}</span>
            </div>

            <div class="info">
                <label for="status" >Created At</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($product->created_at)) }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified At</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($product->updated_at)) }}</span>
            </div>
        </div>       
    </div>

    @if (count($product->imageObjects) != 0)
    <div id="image_view_div" class="image-viewer image-viewer-hide">
        <span class="image-viewer-close" id="image_viewer_close_trigger"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></span>

        @if (count($product->imageObjects) > 1)
        <span class="buttons" id="previous"><svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M423-59 2-480l421-421 78 79-342 342 342 342-78 79Z"/></svg></span>
        @endif
        
        
        <div class="image-panel">
            @foreach ($product->imageObjects as $image)
            <img src="{{ asset('storage/'.$image->url) }}" class="{{ ($loop->iteration == 1) ? 'active' : '' }}" alt="Product Image" data-id="{{ $loop->iteration }}">
            @endforeach
        </div>
        
        
        @if (count($product->imageObjects) > 1)
        <span class="buttons" id="next"><svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="m305-61-79-79 342-342-342-342 79-79 420 421L305-61Z"/></svg></span>
        @endif
    </div>        
    @endif

    @can('Products Delete')
    <div id="product_delete_div" class="product-delete">
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" id="delete_form">
            @csrf
            @method('DELETE')

            <legend>Delete Product</legend>

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
        <link rel="stylesheet" href="{{ asset('css/product/show.css') }}">
    @endpush

    @push('JS')
        <script src="{{ asset('js/product/show.js') }}"></script>
        @if (Session::has('product_added'))
            <script>
                toastr.success("{!! Session::pull('product_added') !!}");
            </script>
        @endif

        @if (Session::has('product_updated'))
            <script>
                toastr.success("{!! Session::pull('product_updated') !!}");
            </script>
        @endif
    @endpush

@endsection
