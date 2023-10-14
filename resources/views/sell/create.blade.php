@extends('default.index')
@section("content")
<div class="sell-create">
    <form action="{{ route('sells.store') }}" method="POST" id="sell_create_form">
        @csrf

        <legend>Add New Sell</legend>

        <div class="customer-info">            
            <div class="form-group">
                <label for="customer_name" >Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" list="customer_list" data-id="{{ ($sell->customer != null) ? $sell->customer_id : '' }}" class="text-field" placeholder="enter customer name" required autocomplete="off" value="{{ ($sell->customer != null) ? $sell->customer->name : '' }}">
                <datalist id="customer_list">
                </datalist>
                <span id="customer_name_error" class="error"></span>
            </div>
        </div>

        <div class="products-info">
            <div class="form-group">
                <label for="product_name" >Product Name</label>
                <input type="text" name="product_name" id="product_name" list="product_list" data-id="" class="text-field" placeholder="enter product name" autocomplete="off">
                <datalist id="product_list">
                </datalist>
            </div>

            <div class="form-group">
                <label for="product_price">Unit Price</label>
                <span id="product_price" class="text-field">TK</span>
            </div>

            <div class="form-group">
                <label for="product_units">Product Units</label>
                <input type="number" name="product_units" id="product_units" class="text-field" autocomplete="off" value="0" disabled min="1">
            </div>

            <div class="form-group">
                <label for="product_discount">Product Discount</label>
                <input type="number" name="product_discount" id="product_discount" class="text-field" autocomplete="off" value="0" disabled min="0">
            </div>

            <div class="form-group">
                <label for="product_total">Total Price</label>
                <span id="product_total" class="text-field">TK</span>
            </div>

            <div class="form-group">
                <button type="button" class="button success shadow click-shadow" id="add_product" disabled>Add</button>
            </div>
        </div>

        <div class="sell-orders">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Units</th>
                        <th></th>
                        <th>Sub-Total</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sell->sellOrders as $so)
                    <tr>
                        <td>
                            <button data-id="{{ $so->id }}" type="button" class="button shadow click-shadow danger delete">X</button>         
                        </td>
                        <td>{{ $loop->iteration.'.' }}</td>
                        <td>{{ $so->product->name }}</td>
                        <td class="right">{{ number_format($so->product->price,2) }}</td>
                        <td class="right">{{ $so->units }}</td>
                        <td>
                            <button data-id="{{ $so->id }}" type="button" class="button shadow click-shadow success add">+</button>
                            <button data-id="{{ $so->id }}" type="button" class="button shadow click-shadow warning sub">-</button>
                        </td>
                        <td class="right">{{ number_format(($so->price * $so->units),2) }}</td>
                        <td class="right">{{ number_format($so->discount,2) }}</td>
                        <td class="right">{{ number_format($so->price * $so->units - $so->discount,2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" rowspan="3">
                            Order Count: <span>{{ count($sell->sellOrders) }}</span>
                            Unit Count: <span>{{ $sell->units }}</span>
                        </td>
                        <td class="right">Total</td>
                        <td class="right"><span id="sell_total">{{ number_format($sell->sub_total,2) }}</span></td>
                    </tr>
            
                    <tr>
                        <td class="right">Discount</td>
                        <td class="right"><input type="number" class="text-field right" value="{{ empty($sell->discount) ? 0 : $sell->discount }}" min="0" id="sell_discount"></td>
                    </tr>
            
                    <tr>
                        <td class="right">Grand Total</td>
                        <td class="right"><span id="sell_grand_total">{{ number_format($sell->sub_total - $sell->discount,2) }}</span></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow danger" id="sell_clear_all" data-id="{{ $sell->id }}" type="button">Clear All</button>
            
            <div>
                <button class="button shadow click-shadow primary" type="submit" id="sell_store">Store</button>
                <a href="{{ route('sells.index') }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/sell/create.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/sell/create.js') }}"></script>

    @if (Session::has('sell_deleted'))
        <script>
            toastr.success("{!! Session::get('sell_deleted') !!}");
        </script>
    @endif
@endpush

@endsection