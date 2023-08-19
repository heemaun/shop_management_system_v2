<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('APP_NAME') }}</title>
        <link rel="shortcut icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/default/index.css') }}">
        @if (Auth::check())
        <link rel="stylesheet" href="{{ asset('css/default/cart.css') }}">
        @else
        <link rel="stylesheet" href="{{ asset('css/default/login.css') }}">
        @endif
        @stack("CSS")
    </head>
    <body>
        <header class="main-header">
            <a href="{{ route('home') }}" class="logo"><img src="{{ asset('image/logo.png') }}" alt="Logo">SMSV2</a>
    
            @if (strcmp(Request::route()->getName(),'home')==0)
                
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#products">Products</a></li>
                </ul>
            </nav>
            
            @endif
    
            <div class="controls">
                @if (Auth::check())
    
                <span class="cart-trigger" id="cart_trigger" title="Cart"><img src="{{ asset('image/add_to_cart.png') }}" alt=""><span></span></span>
    
                <a href="{{ route('logout') }}" class="login-controls" title="Logout"><img src="{{ asset('image/logout.png') }}" alt=""></a>
    
                @else
    
                <span id="login_trigger" class="login-controls" title="Login"><img src="{{ asset('image/login.png') }}" alt=""></span>
    
                @endif
            </div>        
        </header>
        
        @yield("content")

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

            <span id="side_bar_toggle" class="side-bar-toggle" title="Show Menu"><img src="{{ asset('image/sidebar_toggle.png') }}" alt=""></span>
        </aside>

        <div id="cart_div" class="cart-div">
            <div class="cart">
                <div class="table-container">
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
        
                        <tfoot>
                            <tr>
                                <td colspan="7" rowspan="3">
                                    Order Count: <span></span>
                                    Unit Count: <span></span>
                                </td>
                                <td>Total</td>
                                <td class="right"><span></span></td>
                            </tr>
                    
                            <tr>
                                <td>Discount</td>
                                <td><input type="number"></td>
                            </tr>
                    
                            <tr>
                                <td>Grand Total</td>
                                <td class="right"><span></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>        
        
                <div class="btn-container">
                    <button class="btn btn-danger" id="cart_clear_all">Clear All</button>
        
                    <div>
                        <button class="btn btn-primary">Confirm</button>
                        <button class="btn btn-secondary" id="cart_close">Close</button>
                    </div>
                </div>
            </div>
        </div>

        @else
        
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

        @endif

        <footer>
            <p>All rights reserve by <a href="https://zamanscorp.com">Zamans Corp</a></p>
            <p>&copy 2021 - {{ date('Y') }}</p>
        </footer>        
        
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/default/index.js') }}"></script>
        @if (Auth::check())
        <script src="{{ asset('js/default/cart.js') }}"></script>
        @else
        <script src="{{ asset('js/default/login.js') }}"></script>
        @endif
        @stack("JS")
    </body>
</html>