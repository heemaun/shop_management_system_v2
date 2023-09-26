@if (count($products) == 0)

<span class="no-data-found">No Data Found!</span>

@else

{{ $products->links() }}

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Category</th>
            <th>Name</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($products as $product)
            <tr data-href="{{ route('products.show',$product->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td>{{ $product->status->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->name }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="7">
                {{ $products->total().' rows of data returned' }}
            </td>
        </tr>
    </tfoot>
</table>

{{ $products->links() }}    

@endif