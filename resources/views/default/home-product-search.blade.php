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