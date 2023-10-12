@foreach ($products as $product)
    <option data-id="{{ $product->id }}" data-name="{{ $product->name }}">{{ $product->name }}</option>
@endforeach
