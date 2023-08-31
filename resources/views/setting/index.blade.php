@extends("default.index")
@section("content")

<div class="settings-index">
    <h2>Settings Index</h2>

    <div class="backgrounds-and-colors" id="backgrounds_and_colors">       
        <div class="container">
            <div class="demo">
                <h3>Demo</h3>
    
                <div class="first-div">
                    <span class="first-span">Inside First Div</span>
    
                    <div class="second-div">
                        <span>Inside Second Div</span>
    
                        <div class="third-div">
                            <span>Inside Third Div</span>
    
                            <div class="fourth-div">                            
                                <span>Inside Fourth Div</span>
    
                                <div class="fifth-div">
                                    <span>Inside Fifth Div</span>
                                    
                                    <div class="sixth-div">
                                        <span>Inside Sixth Div</span>

                                        <nav class="nav">
                                            <span class="logo">Logo</span>

                                            <ul>
                                                <li>Item 1</li>
                                                <li>Item 2</li>
                                                <li>Item 3</li>
                                                <li>Item 4</li>
                                                <li>Item 5</li>
                                            </ul>
                                        </nav>

                                        <h1 class="banner">This is banner</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="controls">
                <div class="sections">
                    <div class="form-group">
                        <label>First Order Background Color</label>
                        <input type="color" id="bg_1" onchange="loadBGAndColor()" value="{{ getSettings('--1st-bg-color') }}">
                        <span id="--1st-bg-color-error" class="error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>First Order Color</label>
                        <input type="color" id="color_1" onchange="loadBGAndColor()" value="{{ getSettings('--1st-color') }}">
                        <span id="--1st-color-error" class="error"></span>
                    </div>
                </div>
                
                <div class="sections">
                    <div class="form-group">
                        <label>Second Order Background Color</label>
                        <input type="color" id="bg_2" onchange="loadBGAndColor()" value="{{ getSettings('--2nd-bg-color') }}">
                        <span id="--2nd-bg-color-error" class="error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Second Order Color</label>
                        <input type="color" id="color_2" onchange="loadBGAndColor()" value="{{ getSettings('--2nd-color') }}">
                        <span id="--2nd-color-error" class="error"></span>
                    </div>
                </div>
    
                <div class="sections">
                    <div class="form-group">
                        <label>Third Order Background Color</label>
                        <input type="color" id="bg_3" onchange="loadBGAndColor()" value="{{ getSettings('--3rd-bg-color') }}">
                        <span id="--3rd-bg-color-error" class="error"></span>
                    </div>
    
                    <div class="form-group">
                        <label>Third Order Color</label>
                        <input type="color" id="color_3" onchange="loadBGAndColor()" value="{{ getSettings('--3rd-color') }}">
                        <span id="--3rd-color-error" class="error"></span>
                    </div>
                </div>
    
                <div class="sections">
                    <div class="form-group">
                        <label>Fourth Order Background Color</label>
                        <input type="color" id="bg_4" onchange="loadBGAndColor()" value="{{ getSettings('--4th-bg-color') }}">
                        <span id="--4th-bg-color-error" class="error"></span>
                    </div>
    
                    <div class="form-group">
                        <label>Fourth Order Color</label>
                        <input type="color" id="color_4" onchange="loadBGAndColor()" value="{{ getSettings('--4th-color') }}">
                        <span id="--4th-color-error" class="error"></span>
                    </div>
                </div>
    
                <div class="sections">
                    <div class="form-group">
                        <label>Fifth Order Background Color</label>
                        <input type="color" id="bg_5" onchange="loadBGAndColor()" value="{{ getSettings('--5th-bg-color') }}">
                        <span id="--5th-bg-color-error" class="error"></span>
                    </div>
    
                    <div class="form-group">
                        <label>Fifth Order Color</label>
                        <input type="color" id="color_5" onchange="loadBGAndColor()" value="{{ getSettings('--5th-color') }}">
                        <span id="--5th-color-error" class="error"></span>
                    </div>
                </div>
    
                <div class="sections">
                    <div class="form-group">
                        <label>Sixth Order Background Color</label>
                        <input type="color" id="bg_6" onchange="loadBGAndColor()" value="{{ getSettings('--6th-bg-color') }}">
                        <span id="--6th-bg-color-error" class="error"></span>
                    </div>
    
                    <div class="form-group">
                        <label>Sixth Order Color</label>
                        <input type="color" id="color_6" onchange="loadBGAndColor()" value="{{ getSettings('--6th-color') }}">
                        <span id="--6th-color-error" class="error"></span>
                    </div>
                </div>

                <div class="sections">
                    <div class="form-group">
                        <label>Nav Background Color</label>
                        <input type="color" id="nav_bg" onchange="loadBGAndColor()" value="{{ getSettings('--nav-bg-color') }}">
                        <span id="--nav-bg-color-error" class="error"></span>
                    </div>
    
                    <div class="form-group">
                        <label>Nav Color</label>
                        <input type="color" id="nav_color" onchange="loadBGAndColor()" value="{{ getSettings('--nav-color') }}">
                        <span id="--nav-color-error" class="error"></span>
                    </div>
                </div>
                
                <div class="sections">
                    <div class="form-group">
                        <label>Logo Color</label>
                        <input type="color" id="logo_color" onchange="loadBGAndColor()" value="{{ getSettings('--logo-color') }}">
                        <span id="--logo-color-error" class="error"></span>
                    </div>

                    <div class="form-group">
                        <label>Banner Color</label>
                        <input type="color" id="banner_color" onchange="loadBGAndColor()" value="{{ getSettings('--banner-color') }}">
                        <span id="--banner-color-error" class="error"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow red" id="clear">Clear</button>
            <button class="button shadow click-shadow green" id="save">Save</button>
            {{-- <button class="button shadow click-shadow gray">Back</button> --}}
        </div>
    </div>

    <div class="fonts" id="fonts"></div>
    <div class="logo-nav-banner" id="logo_nav_banner"></div>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/setting/index.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/setting/index.js') }}"></script>

    @if (Session::has('setting_updated'))
        <script>
            toastr.success("{!! Session::get('setting_updated') !!}");
        </script>
    @endif
@endpush

@endsection