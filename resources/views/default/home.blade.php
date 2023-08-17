@extends('default.index')
@section('content')

<div class="home">
    {{-- {{ print_r($sell->sellOrders) }} --}}
    {{-- <header class="main-header">
        <a href="{{ route('home') }}" class="logo"><img src="{{ asset('image/logo.png') }}" alt="Logo">SMSV2</a>

        <div class="form-group">          
            <input type="text" id="product_search" placeholder="search product by name" class="form-control streched">
        </div>

        <div class="form-group streched">
            <input type="text" id="category_search" placeholder="search product by category name" class="form-control">

            <div class="result">
                <ul id="result_ul">
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                    <li>Item 4</li>
                    <li>Item 5</li>
                </ul>
            </div>
        </div>

        @if (Auth::check())
        <span class="cart"><img src="{{ asset('image/add_to_cart.png') }}" alt=""><span>99</span></span>

        <a href="{{ route('logout') }}" class="login-controls"><img src="{{ asset('image/logout.png') }}" alt=""></a>

        @else

        <span id="login_trigger" class="login-controls"><img src="{{ asset('image/login.png') }}" alt=""></span>

        @endif
    </header>

    <main>
        <h1>Shop Management System V2</h1>
    </main>

    @if (Auth::check())
    <aside>
        <nav>
            <ul>
                <li><a href="{{ route('users.index') }}">Users</a></li>
                <li><a href="{{ route('users.index') }}">Account</a></li>
                <li><a href="{{ route('users.index') }}">Products</a></li>
                <li><a href="{{ route('users.index') }}">Purchases</a></li>
                <li><a href="{{ route('users.index') }}">Purchase Orders</a></li>
                <li><a href="{{ route('users.index') }}">Sells</a></li>
                <li><a href="{{ route('users.index') }}">Sell Orders</a></li>
                <li><a href="{{ route('users.index') }}">Settings</a></li>
                <li><a href="{{ route('users.index') }}">Statuses</a></li>
                <li><a href="{{ route('users.index') }}">Transactions</a></li>
            </ul>
        </nav>

        <span id="side_bar_toggle" class="side-bar-toggle"><img src="{{ asset('image/sidebar_toggle.png') }}" alt=""></span>
    </aside>


    @endif --}}

    <section class="products-list">
        <h2>Product List</h2>

        <div class="products">
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
                            <a href="{{ route('add-to-cart') }}" data-id="{{ $product->id }}" class="btn btn-success add-to-cart">ADD TO CART</a>

                            <button type="button" data-id="{{ $product->id }}" class="btn btn-primary" id="product_view_trigger">View Details</button>
                        </div>
                    </footer>

                </article>
            @endforeach
        </div>        
    </section>

    {{-- <footer>
        <p>All rights reserve by <a href="https://zamanscorp.com">Zamans Corp</a></p>
        <p>&copy 2021 - {{ date('Y') }}</p>
    </footer> --}}
</div>

<div id="login_div" class="login-div">
    <form action="{{ route('login') }}" method="POST" class="my-form" id="login_form">
        @csrf
        <legend>Login</legend>

        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" class="form-control" placeholder="enter your username" autocomplete="off">
            <span class="error" id="username_error"></span>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" placeholder="enter your password" autocomplete="off">
            <span class="error" id="password_error"></span>
        </div>

        <span>Don't have an account? <a href="{{ route('users.create') }}">Register Here</a></span>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Login</button>
            <button type="button" class="btn btn-success" id="login_close">Close</button>
        </div>
    </form>
</div>

{{-- <div id="product_details_div" class="product-details">
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
            <a href="{{ route('add-to-cart') }}" data-id="{{ $product->id }}" class="btn btn-success add-to-cart">ADD TO CART</a>
            <button type="button" class="btn btn-secondary" id="product_view_close">Close</button>
        </div>
    </article>
</div> --}}

<div id="cart_div" class="cart-div">
    <div class="cart">
    <table class="table table-bordered table-striped">
        <thead>
            <th></th>
            <th>No.</th>
            <th>Name</th>
            <th>Price [Tk]</th>
            <th>Units</th>
            <th></th>
            <th>Sub-Total [Tk]</th>
            <th>Discount [Tk]</th>
            <th>Total [Tk]</th>
        </thead>

        <tbody>
            @foreach ($sell->sellOrders as $so)
                <tr>
                    <td>
                        <button data-id="{{ $so->id }}" class="btn btn-danger product delete">X</button>         
                    </td>
                    <td>{{ $loop->iteration.'.' }}</td>
                    <td>{{ $so->product->name }}</td>
                    <td class="right">{{ number_format($so->product->price,2) }}</td>
                    <td class="right">{{ $so->units }}</td>
                    <td>
                        <button data-id="{{ $so->id }}" class="btn btn-success product add">+</button>
                        <button data-id="{{ $so->id }}" class="btn btn-warning product sub">-</button>
                    </td>
                    <td class="right">{{ number_format($so->price,2) }}</td>
                    <td class="right">{{ number_format($so->discount,2) }}</td>
                    <td class="right">{{ number_format($so->price - $so->discount,2) }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="7" rowspan="3">
                    Order Count: <span>{{ count($sell->sellOrders) }}</span>
                    Unit Count: <span>{{ $sell->units }}</span>
                </td>
                <td>Total</td>
                <td class="right"><span>{{ number_format($sell->sub_total,2) }}</span></td>
            </tr>

            <tr>
                <td>Discount</td>
                <td><input type="number"></td>
            </tr>

            <tr>
                <td>Grand Total</td>
                <td class="right"><span>{{ number_format($sell->sub_total - $sell->discount,2) }}</span></td>
            </tr>
        </tfoot>
    </table>

    <div class="btn-container">
        <button class="btn btn-primary">Confirm</button>
        <button class="btn btn-secondary">Close</button>
        <button class="btn btn-danger">Clear All</button>
    </div>
</div>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/default/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default/cart.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/default/home.js') }}"></script>
@endpush

@endsection
