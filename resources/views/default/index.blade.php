<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ getSettings('app-name') }}</title>
    <link rel="shortcut icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <style>
        :root{
            --1st-bg-color: {{ getSettings('--1st-bg-color') }};
            --2nd-bg-color: {{ getSettings('--2nd-bg-color') }};
            --3rd-bg-color: {{ getSettings('--3rd-bg-color') }};
            --4th-bg-color: {{ getSettings('--4th-bg-color') }};
            --5th-bg-color: {{ getSettings('--5th-bg-color') }};
            --6th-bg-color: {{ getSettings('--6th-bg-color') }};

            --1st-color: {{ getSettings('--1st-color') }};
            --2nd-color: {{ getSettings('--2nd-color') }};
            --3rd-color: {{ getSettings('--3rd-color') }};
            --4th-color: {{ getSettings('--4th-color') }};
            --5th-color: {{ getSettings('--5th-color') }};
            --6th-color: {{ getSettings('--6th-color') }};

            --h2-font-size: {{ getSettings('--h2-font-size') }};
            --h3-font-size: {{ getSettings('--h3-font-size') }};
            --h4-font-size: {{ getSettings('--h4-font-size') }};
            --text-field-font-size: {{ getSettings('--text-field-font-size') }};
            --label-font-size: {{ getSettings('--label-font-size') }};
            --default-font-size: {{ getSettings('--default-font-size') }};
            --th-font-size: {{ getSettings('--th-font-size') }};
            --td-font-size: {{ getSettings('--td-font-size') }};

            --h2-font-weight: {{ getSettings('--h2-font-weight') }};
            --h3-font-weight: {{ getSettings('--h3-font-weight') }};
            --h4-font-weight: {{ getSettings('--h4-font-weight') }};
            --text-field-font-weight: {{ getSettings('--text-field-font-weight') }};
            --label-font-weight: {{ getSettings('--label-font-weight') }};
            --default-font-weight: {{ getSettings('--default-font-weight') }};
            --th-font-weight: {{ getSettings('--th-font-weight') }};
            --td-font-weight: {{ getSettings('--td-font-weight') }};

            --h2-font-style: {{ getSettings('--h2-font-style') }};
            --h3-font-style: {{ getSettings('--h3-font-style') }};
            --h4-font-style: {{ getSettings('--h4-font-style') }};
            --text-field-font-style: {{ getSettings('--text-field-font-style') }};
            --label-font-style: {{ getSettings('--label-font-style') }};
            --default-font-style: {{ getSettings('--default-font-style') }};
            --th-font-style: {{ getSettings('--th-font-style') }};
            --td-font-style: {{ getSettings('--td-font-style') }};

            --h2-font-family: {{ getSettings('--h2-font-family') }};
            --h3-font-family: {{ getSettings('--h3-font-family') }};
            --h4-font-family: {{ getSettings('--h4-font-family') }};
            --text-field-font-family: {{ getSettings('--text-field-font-family') }};
            --label-font-family: {{ getSettings('--label-font-family') }};
            --default-font-family: {{ getSettings('--default-font-family') }};
            --th-font-family: {{ getSettings('--th-font-family') }};
            --td-font-family: {{ getSettings('--td-font-family') }};

            --text-field-border-radius: {{ getSettings('--text-field-border-radius') }};
            --button-border-radius: {{ getSettings('--button-border-radius') }};
            --section1-border-radius: {{ getSettings('--section1-border-radius') }};
            --section2-border-radius: {{ getSettings('--section2-border-radius') }};
            --section3-border-radius: {{ getSettings('--section3-border-radius') }};
            --form-border-radius: {{ getSettings('--form-border-radius') }};

            --logo-color: {{ getSettings('--logo-color') }};
            --logo-font-size: {{ getSettings('--logo-font-size') }};
            --logo-font-weight: {{ getSettings('--logo-font-weight') }};
            --logo-font-style: {{ getSettings('--logo-font-style') }};
            --logo-font-family: {{ getSettings('--logo-font-family') }};

            --nav-bg-color: {{ getSettings('--nav-bg-color') }};
            --nav-color: {{ getSettings('--nav-color') }};
            --nav-font-size: {{ getSettings('--nav-font-size') }};
            --nav-font-weight: {{ getSettings('--nav-font-weight') }};
            --nav-font-style: {{ getSettings('--nav-font-style') }};
            --nav-font-family: {{ getSettings('--nav-font-family') }};
            
            --banner-color: {{ getSettings('--banner-color') }};
            --banner-font-size: {{ getSettings('--banner-font-size') }};
            --banner-font-weight: {{ getSettings('--banner-font-weight') }};
            --banner-font-style: {{ getSettings('--banner-font-style') }};
            --banner-font-family: {{ getSettings('--banner-font-family') }};

            --button-default-bg-color: {{ getSettings('--button-default-bg-color') }};
            --button-default-color: {{ getSettings('--button-default-color') }};
            --button-primary-bg-color: {{ getSettings('--button-primary-bg-color') }};
            --button-primary-color: {{ getSettings('--button-primary-color') }};
            --button-secondary-bg-color: {{ getSettings('--button-secondary-bg-color') }};
            --button-secondary-color: {{ getSettings('--button-secondary-color') }};
            --button-success-bg-color: {{ getSettings('--button-success-bg-color') }};
            --button-success-color: {{ getSettings('--button-success-color') }};
            --button-info-bg-color: {{ getSettings('--button-info-bg-color') }};
            --button-info-color: {{ getSettings('--button-info-color') }};
            --button-warning-bg-color: {{ getSettings('--button-warning-bg-color') }};
            --button-warning-color: {{ getSettings('--button-warning-color') }};
            --button-danger-bg-color: {{ getSettings('--button-danger-bg-color') }};
            --button-danger-color: {{ getSettings('--button-danger-color') }};
            --button-light-bg-color: {{ getSettings('--button-light-bg-color') }};
            --button-light-color: {{ getSettings('--button-light-color') }};
            --button-dark-bg-color: {{ getSettings('--button-dark-bg-color') }};
            --button-dark-color: {{ getSettings('--button-dark-color') }};
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/my-design/my-design.css') }}">
    <link rel="stylesheet" href="{{ asset('css/default/index.css') }}">
    @if (Auth::check())
        <link rel="stylesheet" href="{{ asset('css/default/cart.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/default/login.css') }}">
    @endif
    @stack('CSS')
</head>

<body>
    <div class="wrapper" id="home">
        <header class="main-header">
            <a href="{{ route('home') }}" class="logo"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M321-240h120v-40h-80v-40h80v-120H321v40h80v40h-80v120Zm280 0h40v-200h-40v80h-40v-80h-40v120h80v80Zm240-278v318q0 33-23.5 56.5T761-120H201q-33 0-56.5-23.5T121-200v-318q-23-21-35.5-54t-.5-72l42-136q8-26 28.5-43t47.5-17h556q27 0 47 16.5t29 43.5l42 136q12 39-.5 71T841-518Zm-272-42q27 0 41-18.5t11-41.5l-22-140h-78v148q0 21 14 36.5t34 15.5Zm-180 0q23 0 37.5-15.5T441-612v-148h-78l-22 140q-4 24 10.5 42t37.5 18Zm-178 0q18 0 31.5-13t16.5-33l22-154h-78l-40 134q-6 20 6.5 43t41.5 23Zm540 0q29 0 42-23t6-43l-42-134h-76l22 154q3 20 16.5 33t31.5 13ZM201-200h560v-282q-5 2-6.5 2H751q-27 0-47.5-9T663-518q-18 18-41 28t-49 10q-27 0-50.5-10T481-518q-17 18-39.5 28T393-480q-29 0-52.5-10T299-518q-21 21-41.5 29.5T211-480h-4.5q-2.5 0-5.5-2v282Zm560 0H201h560Z"/></svg>SMSV2</a>

            <div class="view-controller" id="view_controller">
                @if (strcmp(Request::route()->getName(), 'home') == 0)
                    <nav>
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#products">Products</a></li>
                        </ul>
                    </nav>
                @endif

                <div class="controls">
                    @if (Auth::check())
                        <span class="cart-trigger" id="cart_trigger" title="Cart">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>

                            <div class="item-count" id="item_count"></div>
                        </span>

                        <a href="{{ route('logout') }}" class="login-controls" title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" title="New User Registration" class="registration">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z"/></svg>
                        </a>

                        <span id="login_trigger" class="login-controls" title="Login">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-120v-80h280v-560H480v-80h280q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H480Zm-80-160-55-58 102-102H120v-80h327L345-622l55-58 200 200-200 200Z"/></svg>
                        </span>
                    @endif
                </div>
            </div>            

            <span class="header-toggler" id="header_toggler"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M666-440 440-666l226-226 226 226-226 226Zm-546-80v-320h320v320H120Zm400 400v-320h320v320H520Zm-400 0v-320h320v320H120Zm80-480h160v-160H200v160Zm467 48 113-113-113-113-113 113 113 113Zm-67 352h160v-160H600v160Zm-400 0h160v-160H200v160Zm160-400Zm194-65ZM360-360Zm240 0Z"/></svg></span>
        </header>
        
        @if (Auth::check())
            <aside>
                <nav>
                    <ul>
                        @can('Users Index')
                        <li><a href="{{ route('users.index') }}" class="{{ (Str_contains(Request::route()->getName(),'users')) ? 'active' : '' }}">Users</a></li>                            
                        @endcan
                        @can('Roles Index')                            
                        <li><a href="{{ route('roles.index') }}" class="{{ (Str_contains(Request::route()->getName(),'roles')) ? 'active' : '' }}">Roles</a></li>
                        @endcan
                        @can('Permissions Index')                            
                        <li><a href="{{ route('permissions.index') }}" class="{{ (Str_contains(Request::route()->getName(),'permissions')) ? 'active' : '' }}">Permissions</a></li>
                        @endcan
                        @can('Accounts Index')                            
                        <li><a href="{{ route('accounts.index') }}" class="{{ (Str_contains(Request::route()->getName(),'accounts')) ? 'active' : '' }}">Accounts</a></li>
                        @endcan
                        @can('Categories Index')                            
                        <li><a href="{{ route('categories.index') }}" class="{{ (Str_contains(Request::route()->getName(),'categories')) ? 'active' : '' }}">Categories</a></li>
                        @endcan
                        @can('Products Index')                            
                        <li><a href="{{ route('products.index') }}" class="{{ (Str_contains(Request::route()->getName(),'products')) ? 'active' : '' }}">Products</a></li>
                        @endcan
                        @can('Purchases Index')                            
                        <li><a href="{{ route('purchases.index') }}" class="{{ (Str_contains(Request::route()->getName(),'purchases')) ? 'active' : '' }}">Purchases</a></li>
                        @endcan
                        @can('Sells Index')                            
                        <li><a href="{{ route('sells.index') }}" class="{{ (Str_contains(Request::route()->getName(),'sells')) ? 'active' : '' }}">Sells</a></li>
                        @endcan
                        @can('Settings Index')                            
                        <li><a href="{{ route('settings.index') }}" class="{{ (Str_contains(Request::route()->getName(),'settings')) ? 'active' : '' }}">Settings</a></li>
                        @endcan
                        @can('Statuses Index')                            
                        <li><a href="{{ route('statuses.index') }}" class="{{ (Str_contains(Request::route()->getName(),'statuses')) ? 'active' : '' }}">Statuses</a></li>
                        @endcan
                        @can('Transactions Index')                            
                        <li><a href="{{ route('transactions.index') }}" class="{{ (Str_contains(Request::route()->getName(),'transactions')) ? 'active' : '' }}">Transactions</a></li>
                        @endcan
                    </ul>
                </nav>

                <span id="side_bar_toggle" class="side-bar-toggle" title="Show Side Bar"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m480-320 160-160-160-160-56 56 64 64H320v80h168l-64 64 56 56Zm0 240q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></span>
            </aside>
        @endif

        <section class="content" id="content">
            @yield('content')
        </section>        

        @if (strcmp(Request::route()->getName(), 'settings.index') != 0)

        <footer class="footer"> 
            <p>All rights reserve by <a href="https://zamanscorp.com">Zamans Corp</a></p>
            <p>&copy 2021 - {{ date('Y') }}</p>
        </footer>

        @endif        
    </div>

    @if (Auth::check())
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
                                <td class="right">Total</td>
                                <td class="right"><span></span></td>
                            </tr>

                            <tr>
                                <td class="right">Discount</td>
                                <td><input type="number"></td>
                            </tr>

                            <tr>
                                <td class="right">Grand Total</td>
                                <td class="right"><span></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="button-container">
                    <button class="button shadow click-shadow danger" id="cart_clear_all">Clear All</button>

                    <div>
                        <button class="button shadow click-shadow primary">Confirm</button>
                        <button class="button shadow click-shadow secondary" id="cart_close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div id="login_div" class="login-div">
            <form action="{{ route('login') }}" method="POST" class="form" id="login_form">
                @csrf
                <legend>Login</legend>

                <div class="form-group">
                    <label for="login_username" >Username</label>

                    <input type="text" id="login_username" class="text-field" placeholder="enter your username" autocomplete="off" required>

                    <span class="error" id="username_error"></span>
                </div>

                <div class="form-group">
                    <label for="login_password" >Password</label>

                    <input type="password" id="login_password" class="text-field" placeholder="enter your password" autocomplete="off" required>

                    <span class="error" id="password_error"></span>
                </div>

                <span>Don't have an account? <a href="{{ route('users.create') }}">Register Here</a></span>

                <div class="button-container">
                    <button type="submit" class="button shadow click-shadow primary">Login</button>
                    
                    <button type="button" class="button shadow click-shadow secondary" id="login_close">Close</button>
                </div>
            </form>
        </div>
    @endif

    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="{{ asset('js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/default/index.js') }}"></script>
    @if (Auth::check())
        <script src="{{ asset('js/default/cart.js') }}"></script>
    @else
        <script src="{{ asset('js/default/login.js') }}"></script>
    @endif
    @stack('JS')
</body>

</html>
