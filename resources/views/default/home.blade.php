@extends('default.index')
@section('content')

<div class="home" id="home">  
    <main>
        <h1>Shop Management System V2</h1>
    </main>    

    <section class="products" id="products">
        <h2>Product List</h2>

        <div class="search-bar">
            <div class="form-group">     
                <label for="product_search" class="form-label">Search product by name</label>     
                <input type="text" id="product_search" placeholder="search product by name" class="form-control streched">
            </div>
            
            <div class="form-group">
                <label for="category_search" class="form-label">Search product by category name</label>     
                <input type="text" id="category_search" placeholder="search product by category name" class="form-control">
    
                <div class="result">
                    <ul id="result_ul">
                    </ul>
                </div>
            </div>
        </div>

        <div class="products-list" id="products_list">
            @foreach ($products as $product)
                <article>
                    <header>
                        <h3>{{ $product->name }}</h3>
                    </header>
                    <section>
                        <img src="{{ asset('image/default_product.jpg') }}" alt="">
                    </section>
                    <footer>
                        <span>{{ 'Price: '.$product->price.' Tk' }}</span>

                        <div class="btn-container">
                            @if (Auth::check())
                                
                            <a href="{{ route('cart.store') }}" data-id="{{ $product->id }}" class="btn btn-success add-to-cart">ADD TO CART</a>

                            @endif

                            <button type="button" data-id="{{ $product->id }}" class="btn btn-primary" id="product_view_trigger">View Details</button>
                        </div>
                    </footer>

                </article>
            @endforeach
        </div>        
    </section>    
</div>



<div id="product_details_div" class="product-details">
    <article>
        <header>
            <h3 id="product_name">Product Name</h3>
        </header>
        <section>
            <img src="{{ asset('image/default_product.jpg') }}" alt="">
            <p id="product_details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt quisquam ut repellendus vitae nulla doloremque qui deleniti blanditiis minus tempore.</p>
        </section>
        <footer>
            <span id="product_price">Price: 500 Tk</span>
        </footer>

        <div class="btn-container">          
            <a href="{{ route('cart.store') }}" data-id="{{ $product->id }}" class="btn btn-success add-to-cart">ADD TO CART</a>
            <button type="button" class="btn btn-secondary" id="product_view_close">Close</button>
        </div>
    </article>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/default/home.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/default/home.js') }}"></script>
@endpush

@endsection
