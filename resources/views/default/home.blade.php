@extends('default.index')
@section('content')

<div class="home">  
    <main>
        <h1>Shop Management System V2</h1>
    </main>    

    <section class="products" id="products">
        <h2>Product List</h2>

        <div class="search-bar">
            <div class="form-group">     
                <label for="product_search" >Search product by name</label>     
                <input type="text" id="product_search" placeholder="search product by name" class="text-field streched">
            </div>
            
            <div class="form-group">
                <label for="category_search" >Search product by category name</label>     
                <input type="text" id="category_search" placeholder="search product by category name" class="text-field">
    
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
                        <span>{{ 'Price: '.$product->price.' Tk' }}</span>
                    </section>

                    <footer>
                        <div class="button-container">
                            @if (Auth::check())
                                
                            <a href="{{ route('cart.store') }}" data-id="{{ $product->id }}" class="button shadow click-shadow success add-to-cart">ADD TO CART</a>

                            @endif

                            <button type="button shadow click-shadow" data-id="{{ $product->id }}" class="button shadow click-shadow blue" id="product_view_trigger">View Details</button>
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

            <span id="product_price">Price: 500 Tk</span>

            <p id="product_details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt quisquam ut repellendus vitae nulla doloremque qui deleniti blanditiis minus tempore.</p>
        </section>

        <footer>            
            <div class="button-container">          
                <a href="{{ route('cart.store') }}" data-id="{{ $product->id }}" class="button shadow click-shadow blue add-to-cart">ADD TO CART</a>

                <button type="button shadow click-shadow" class="button shadow click-shadow gray" id="product_view_close">Close</button>
            </div>
        </footer>
    </article>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/default/home.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/default/home.js') }}"></script>
@endpush

@endsection
