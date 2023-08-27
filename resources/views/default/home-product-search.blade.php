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
                    
                <a href="{{ route('cart.store') }}" data-id="{{ $product->id }}" class="button shadow click-shadow green add-to-cart">ADD TO CART</a>

                @endif

                <button type="button shadow click-shadow" data-id="{{ $product->id }}" class="button shadow click-shadow blue" id="product_view_trigger">View Details</button>
            </div>
        </footer>

    </article>
@endforeach