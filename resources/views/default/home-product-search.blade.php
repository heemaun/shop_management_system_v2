@if (count($products) == 0)
    <span class="no-data-found">No Data Found!</span>
@else
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
            <a href="{{ route('cart.store') }}" data-id="{{ $product->id }}" class="button shadow click-shadow success add-to-cart">ADD TO CART</a>
            <button type="button shadow click-shadow" data-id="{{ $product->id }}" class="button shadow click-shadow primary" id="product_view_trigger">View Details</button>
        </div>
    </footer>
</article>
@endforeach
@endif