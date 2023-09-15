@extends("default.index")
@section("content")

<div class="settings-index">
    <h2>Settings Index</h2>

    <nav id="nav">
        <ul>
            <li data-target="backgrounds_and_colors">Backgrounds & Colors</li>
            <li data-target="fonts">Fonts</li>
            <li class="active" data-target="buttons">Buttons</li>
            <li data-target="miscellaneous">Miscellaneous</li>
        </ul>
    </nav>

    <div class="panels">
        <div class="backgrounds-and-colors" id="backgrounds_and_colors">       
            <div class="container">
                <div class="output">
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
                        </div>
                        
                        <div class="form-group">
                            <label>First Order Color</label>
                            <input type="color" id="color_1" onchange="loadBGAndColor()" value="{{ getSettings('--1st-color') }}">
                        </div>
                    </div>
                    
                    <div class="sections">
                        <div class="form-group">
                            <label>Second Order Background Color</label>
                            <input type="color" id="bg_2" onchange="loadBGAndColor()" value="{{ getSettings('--2nd-bg-color') }}">
                        </div>
                        
                        <div class="form-group">
                            <label>Second Order Color</label>
                            <input type="color" id="color_2" onchange="loadBGAndColor()" value="{{ getSettings('--2nd-color') }}">
                        </div>
                    </div>
        
                    <div class="sections">
                        <div class="form-group">
                            <label>Third Order Background Color</label>
                            <input type="color" id="bg_3" onchange="loadBGAndColor()" value="{{ getSettings('--3rd-bg-color') }}">
                        </div>
        
                        <div class="form-group">
                            <label>Third Order Color</label>
                            <input type="color" id="color_3" onchange="loadBGAndColor()" value="{{ getSettings('--3rd-color') }}">
                        </div>
                    </div>
        
                    <div class="sections">
                        <div class="form-group">
                            <label>Fourth Order Background Color</label>
                            <input type="color" id="bg_4" onchange="loadBGAndColor()" value="{{ getSettings('--4th-bg-color') }}">
                        </div>
        
                        <div class="form-group">
                            <label>Fourth Order Color</label>
                            <input type="color" id="color_4" onchange="loadBGAndColor()" value="{{ getSettings('--4th-color') }}">
                        </div>
                    </div>
        
                    <div class="sections">
                        <div class="form-group">
                            <label>Fifth Order Background Color</label>
                            <input type="color" id="bg_5" onchange="loadBGAndColor()" value="{{ getSettings('--5th-bg-color') }}">
                        </div>
        
                        <div class="form-group">
                            <label>Fifth Order Color</label>
                            <input type="color" id="color_5" onchange="loadBGAndColor()" value="{{ getSettings('--5th-color') }}">
                        </div>
                    </div>
        
                    <div class="sections">
                        <div class="form-group">
                            <label>Sixth Order Background Color</label>
                            <input type="color" id="bg_6" onchange="loadBGAndColor()" value="{{ getSettings('--6th-bg-color') }}">
                        </div>
        
                        <div class="form-group">
                            <label>Sixth Order Color</label>
                            <input type="color" id="color_6" onchange="loadBGAndColor()" value="{{ getSettings('--6th-color') }}">
                        </div>
                    </div>
    
                    <div class="sections">
                        <div class="form-group">
                            <label>Nav Background Color</label>
                            <input type="color" id="nav_bg" onchange="loadBGAndColor()" value="{{ getSettings('--nav-bg-color') }}">
                        </div>
        
                        <div class="form-group">
                            <label>Nav Color</label>
                            <input type="color" id="nav_color" onchange="loadBGAndColor()" value="{{ getSettings('--nav-color') }}">
                        </div>
                    </div>
                    
                    <div class="sections">
                        <div class="form-group">
                            <label>Logo Color</label>
                            <input type="color" id="logo_color" onchange="loadBGAndColor()" value="{{ getSettings('--logo-color') }}">
                        </div>
    
                        <div class="form-group">
                            <label>Banner Color</label>
                            <input type="color" id="banner_color" onchange="loadBGAndColor()" value="{{ getSettings('--banner-color') }}">
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="button-container">
                <button class="button shadow click-shadow red" id="bg_color_clear">Clear</button>
                <button class="button shadow click-shadow green" id="bg_color_save">Save</button>
            </div>
        </div>
    
        <div class="fonts" id="fonts">
            <div class="sections">
                <h3>Heading 2 Font</h3>

                <div class="form-group">
                    <label for="--h2-font-size">Font Size <span>{{ '['.getSettings('--h2-font-size',false).']' }}</span></label>

                    <input id="--h2-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--h2-font-size',true) }}" class="text-field" data-target="h2" onchange="loadDemo(this)">
                    
                    <span id="h2-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--h2-font-weight">Font Weight</label>
                    <select name="--h2-font-weight" id="--h2-font-weight" data-target="h2" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--h2-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="h2-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--h2-font-style">Font Style</label>
                    <select name="--h2-font-style" id="--h2-font-style"  data-target="h2" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--h2-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--h2-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="h2-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--h2-font-family">Font Family</label>
                    <select name="--h2-font-family" id="--h2-font-family"  data-target="h2" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--h2-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--h2-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--h2-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="h2-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <h2 id="h2">Heading 2</h2>
                </div>
            </div>
            <div class="sections">
                <h3>Heading 3 Font</h3>

                <div class="form-group">
                    <label for="--h3-font-size">Font Size <span>{{ '['.getSettings('--h3-font-size',false).']' }}</span></label>

                    <input id="--h3-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--h3-font-size',true) }}" class="text-field" data-target="h3" onchange="loadDemo(this)">
                    
                    <span id="h3-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--h3-font-weight">Font Weight</label>
                    <select name="--h3-font-weight" id="--h3-font-weight" data-target="h3" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--h3-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="h3-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--h3-font-style">Font Style</label>
                    <select name="--h3-font-style" id="--h3-font-style"  data-target="h3" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--h3-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--h3-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="h3-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--h3-font-family">Font Family</label>
                    <select name="--h3-font-family" id="--h3-font-family"  data-target="h3" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--h3-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--h3-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--h3-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="h3-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <h3 id="h3">Heading 3</h3>
                </div>
            </div>
            <div class="sections">
                <h3>Heading 4 Font</h3>

                <div class="form-group">
                    <label for="--h4-font-size">Font Size <span>{{ '['.getSettings('--h4-font-size',false).']' }}</span></label>

                    <input id="--h4-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--h4-font-size',true) }}" class="text-field" data-target="h4" onchange="loadDemo(this)">
                    
                    <span id="h4-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--h4-font-weight">Font Weight</label>
                    <select name="--h4-font-weight" id="--h4-font-weight" data-target="h4" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--h4-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="h4-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--h4-font-style">Font Style</label>
                    <select name="--h4-font-style" id="--h4-font-style"  data-target="h4" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--h4-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--h4-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="h4-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--h4-font-family">Font Family</label>
                    <select name="--h4-font-family" id="--h4-font-family"  data-target="h4" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--h4-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--h4-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--h4-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="h4-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <h4 id="h4">Heading 4</h4>
                </div>
            </div>
            <div class="sections">
                <h3>Text Fields, Buttons & Options Font</h3>

                <div class="form-group">
                    <label for="--text-field-font-size">Font Size <span>{{ '['.getSettings('--text-field-font-size',false).']' }}</span></label>

                    <input id="--text-field-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--text-field-font-size',true) }}" class="text-field" data-target="multi" onchange="loadMultiDemo(this)">
                    
                    <span id="text-field-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--text-field-font-weight">Font Weight</label>
                    <select name="--text-field-font-weight" id="--text-field-font-weight" data-target="multi" onchange="loadMultiDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--text-field-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="text-field-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--text-field-font-style">Font Style</label>
                    <select name="--text-field-font-style" id="--text-field-font-style"  data-target="multi" onchange="loadMultiDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--text-field-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--text-field-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="text-field-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--text-field-font-family">Font Family</label>
                    <select name="--text-field-font-family" id="--text-field-font-family"  data-target="multi" onchange="loadMultiDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--text-field-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--text-field-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--text-field-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="text-field-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <input value="Text Field" class="text-field multi">
                    <select class="multi">
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                        <option value="">Option 3</option>
                    </select>
                    <button class="button multi">Button</button>
                </div>
            </div>
            <div class="sections">
                <h3>Label Font</h3>

                <div class="form-group">
                    <label for="--label-font-size">Font Size <span>{{ '['.getSettings('--label-font-size',false).']' }}</span></label>

                    <input id="--label-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--label-font-size',true) }}" class="text-field" data-target="label" onchange="loadDemo(this)">
                    
                    <span id="label-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--label-font-weight">Font Weight</label>
                    <select name="--label-font-weight" id="--label-font-weight" data-target="label" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--label-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="label-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--label-font-style">Font Style</label>
                    <select name="--label-font-style" id="--label-font-style"  data-target="label" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--label-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--label-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="label-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--label-font-family">Font Family</label>
                    <select name="--label-font-family" id="--label-font-family"  data-target="label" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--label-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--label-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--label-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="label-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <label id="label">Label</label>
                </div>
            </div>
            <div class="sections">
                <h3>Default Font</h3>

                <div class="form-group">
                    <label for="--default-font-size">Font Size <span>{{ '['.getSettings('--default-font-size',false).']' }}</span></label>

                    <input id="--default-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--default-font-size',true) }}" class="text-field" data-target="default" onchange="loadDemo(this)">
                    
                    <span id="default-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--default-font-weight">Font Weight</label>
                    <select name="--default-font-weight" id="--default-font-weight" data-target="default" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--default-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="default-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--default-font-style">Font Style</label>
                    <select name="--default-font-style" id="--default-font-style"  data-target="default" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--default-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--default-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="default-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--default-font-family">Font Family</label>
                    <select name="--default-font-family" id="--default-font-family"  data-target="default" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--default-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--default-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--default-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="default-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <span id="default">Heading 2</span>
                </div>
            </div>
            <div class="sections">
                <h3>Table Header Font</h3>

                <div class="form-group">
                    <label for="--th-font-size">Font Size <span>{{ '['.getSettings('--th-font-size',false).']' }}</span></label>

                    <input id="--th-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--th-font-size',true) }}" class="text-field" data-target="th" onchange="loadDemo(this)">
                    
                    <span id="th-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--th-font-weight">Font Weight</label>
                    <select name="--th-font-weight" id="--th-font-weight" data-target="th" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--th-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="th-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--th-font-style">Font Style</label>
                    <select name="--th-font-style" id="--th-font-style"  data-target="th" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--th-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--th-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="th-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--th-font-family">Font Family</label>
                    <select name="--th-font-family" id="--th-font-family"  data-target="th" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--th-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--th-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--th-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="th-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <table class="table">
                        <thead>
                            <tr>
                                <th id="th">Table Header</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="sections">
                <h3>Table Body Font</h3>

                <div class="form-group">
                    <label for="--td-font-size">Font Size <span>{{ '['.getSettings('--td-font-size',false).']' }}</span></label>

                    <input id="--td-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--td-font-size',true) }}" class="text-field" data-target="td" onchange="loadDemo(this)">
                    
                    <span id="td-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--td-font-weight">Font Weight</label>
                    <select name="--td-font-weight" id="--td-font-weight" data-target="td" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--td-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="td-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--td-font-style">Font Style</label>
                    <select name="--td-font-style" id="--td-font-style"  data-target="td" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--td-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--td-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="td-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--td-font-family">Font Family</label>
                    <select name="--td-font-family" id="--td-font-family"  data-target="td" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--td-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--td-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--td-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="td-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td id="td">Table Body</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="sections">
                <h3>Logo Font</h3>

                <div class="form-group">
                    <label for="--logo-font-size">Font Size <span>{{ '['.getSettings('--logo-font-size',false).']' }}</span></label>

                    <input id="--logo-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--logo-font-size',true) }}" class="text-field" data-target="logo" onchange="loadDemo(this)">
                    
                    <span id="logo-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--logo-font-weight">Font Weight</label>
                    <select name="--logo-font-weight" id="--logo-font-weight" data-target="logo" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--logo-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="logo-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--logo-font-style">Font Style</label>
                    <select name="--logo-font-style" id="--logo-font-style"  data-target="logo" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--logo-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--logo-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="logo-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--logo-font-family">Font Family</label>
                    <select name="--logo-font-family" id="--logo-font-family"  data-target="logo" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--logo-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--logo-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--logo-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="logo-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <span class="logo" id="logo">Logo</span>
                </div>
            </div>
            <div class="sections">
                <h3>Navigation Font</h3>

                <div class="form-group">
                    <label for="--nav-font-size">Font Size <span>{{ '['.getSettings('--nav-font-size',false).']' }}</span></label>

                    <input id="--nav-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--nav-font-size',true) }}" class="text-field" data-target="nav-item" onchange="loadDemo(this)">
                    
                    <span id="nav-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--nav-font-weight">Font Weight</label>
                    <select name="--nav-font-weight" id="--nav-font-weight" data-target="nav-item" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--nav-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="nav-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--nav-font-style">Font Style</label>
                    <select name="--nav-font-style" id="--nav-font-style"  data-target="nav-item" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--nav-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--nav-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="nav-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--nav-font-family">Font Family</label>
                    <select name="--nav-font-family" id="--nav-font-family"  data-target="nav-item" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--nav-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--nav-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--nav-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="nav-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <nav>
                        <ul>
                            <li id="nav-item">Item</li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="sections">
                <h3>Banner Font</h3>

                <div class="form-group">
                    <label for="--banner-font-size">Font Size <span>{{ '['.getSettings('--banner-font-size',false).']' }}</span></label>

                    <input id="--banner-font-size" type="range" min="4" max="100" step="4" value="{{ getSettings('--banner-font-size',true) }}" class="text-field" data-target="banner" onchange="loadDemo(this)">
                    
                    <span id="banner-font-size-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--banner-font-weight">Font Weight</label>
                    <select name="--banner-font-weight" id="--banner-font-weight" data-target="banner" onchange="loadDemo(this)">
                        <option value="">Select a font weight</option>
                        @for ($x = 100;$x<1000;$x+=100)
                        <option value="{{ $x }}" {{ (getSettings('--banner-font-weight') == $x) ? 'selected' : '' }}>{{ $x }}</option>
                        @endfor
                    </select>
                    <span id="banner-font-weight-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--banner-font-style">Font Style</label>
                    <select name="--banner-font-style" id="--banner-font-style"  data-target="banner" onchange="loadDemo(this)">
                        <option value="">Select a font style</option>
                        <option value="normal" {{ (strcmp(getSettings('--banner-font-style'),'normal') == 0) ? 'selected' : '' }}>Normal</option>
                        <option value="italic" {{ (strcmp(getSettings('--banner-font-style'),'italic') == 0) ? 'selected' : '' }}>Italic</option>
                    </select>
                    <span id="banner-font-style-error" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="--banner-font-family">Font Family</label>
                    <select name="--banner-font-family" id="--banner-font-family"  data-target="banner" onchange="loadDemo(this)">
                        <option value="">Select a font family</option>
                        <option value="acme" {{ (strcmp(getSettings('--banner-font-family',true),'acme')==0) ? 'selected' : '' }}>Acme</option>
                        <option value="roboto" {{ (strcmp(getSettings('--banner-font-family',true),'roboto')==0) ? 'selected' : '' }}>Roboto</option>
                        <option value="ubuntu" {{ (strcmp(getSettings('--banner-font-family',true),'ubuntu')==0) ? 'selected' : '' }}>Ubuntu</option>
                    </select>
                    <span id="banner-font-family-error" class="error"></span>
                </div>
                
                <div class="output">
                    <h1 id="banner">Banner</h1>
                </div>
            </div>
            <div class="button-container">
                <button class="button shadow click-shadow red" id="font_clear">Clear</button>
                <button class="button shadow click-shadow green" id="font_save">Save</button>
                {{-- <button class="button shadow click-shadow gray">Back</button> --}}
            </div>
        </div>

        <div class="buttons div-active" id="buttons">
            <div class="buttons-list">
                <button id="button-default" class="button">Default</button>
                <button id="primary" class="button primary">Primary</button>
                <button id="secondary" class="button secondary">Secondary</button>
                <button id="success" class="button success">Success</button>
                <button id="info" class="button info">Info</button>
                <button id="warning" class="button warning">Warning</button>
                <button id="danger" class="button danger">Danger</button>
                <button id="light" class="button light">Light</button>
                <button id="dark" class="button dark">Dark</button>
            </div>

            <div class="controls">
                <div class="section">
                    <div class="form-group">
                        <label for="">Default Button Background</label>
                        <input type="color" id="--button-default-bg-color" value="{{ getSettings('--button-default-bg-color',true) }}" onchange=loadButton(this) data-target="button-default">
                    </div>
                    <div class="form-group">
                        <label for="">Default Button Text</label>
                        <input type="color" id="--button-default-color" value="{{ getSettings('--button-default-color',true) }}" onchange=loadButton(this) data-target="button-default">
                    </div>
                </div>
                <div class="section">
                    <div class="form-group">
                        <label for="">Primary Button Background</label>
                        <input type="color" id="--button-primary-bg-color" value="{{ getSettings('--button-primary-bg-color',true) }}" onchange=loadButton(this) data-target="primary">
                    </div>
                    <div class="form-group">
                        <label for="">Primary Button Text</label>
                        <input type="color" id="--button-primary-color" value="{{ getSettings('--button-primary-color',true) }}" onchange=loadButton(this) data-target="primary">
                    </div>
                </div>
                <div class="section">
                    <div class="form-group">
                        <label for="">Secondary Button Background</label>
                        <input type="color" id="--button-secondary-bg-color" value="{{ getSettings('--button-secondary-bg-color',true) }}" onchange=loadButton(this) data-target="secondary">
                    </div>
                    <div class="form-group">
                        <label for="">Secondary Button Text</label>
                        <input type="color" id="--button-secondary-color" value="{{ getSettings('--button-secondary-color',true) }}" onchange=loadButton(this) data-target="secondary">
                    </div>
                </div>
                <div class="section">
                    <div class="form-group">
                        <label for="">Success Button Background</label>
                        <input type="color" id="--button-success-bg-color" value="{{ getSettings('--button-success-bg-color',true) }}" onchange=loadButton(this) data-target="success">
                    </div>
                    <div class="form-group">
                        <label for="">Success Button Text</label>
                        <input type="color" id="--button-success-color" value="{{ getSettings('--button-success-color',true) }}" onchange=loadButton(this) data-target="success">
                    </div>
                </div>
                <div class="section">
                    <div class="form-group">
                        <label for="">Info Button Background</label>
                        <input type="color" id="--button-info-bg-color" value="{{ getSettings('--button-info-bg-color',true) }}" onchange=loadButton(this) data-target="info">
                    </div>
                    <div class="form-group">
                        <label for="">Info Button Text</label>
                        <input type="color" id="--button-info-color" value="{{ getSettings('--button-info-color',true) }}" onchange=loadButton(this) data-target="info">
                    </div>
                </div>
                <div class="section">
                    <div class="form-group">
                        <label for="">Warning Button Background</label>
                        <input type="color" id="--button-warning-bg-color" value="{{ getSettings('--button-warning-bg-color',true) }}" onchange=loadButton(this) data-target="warning">
                    </div>
                    <div class="form-group">
                        <label for="">Warning Button Text</label>
                        <input type="color" id="--button-warning-color" value="{{ getSettings('--button-warning-color',true) }}" onchange=loadButton(this) data-target="warning">
                    </div>
                </div>
                <div class="section">
                    <div class="form-group">
                        <label for="">Danger Button Background</label>
                        <input type="color" id="--button-danger-bg-color" value="{{ getSettings('--button-danger-bg-color',true) }}" onchange=loadButton(this) data-target="danger">
                    </div>
                    <div class="form-group">
                        <label for="">Danger Button Text</label>
                        <input type="color" id="--button-danger-color" value="{{ getSettings('--button-danger-color',true) }}" onchange=loadButton(this) data-target="danger">
                    </div>
                </div>
                <div class="section">
                    <div class="form-group">
                        <label for="">Light Button Background</label>
                        <input type="color" id="--button-light-bg-color" value="{{ getSettings('--button-light-bg-color',true) }}" onchange=loadButton(this) data-target="light">
                    </div>
                    <div class="form-group">
                        <label for="">Light Button Text</label>
                        <input type="color" id="--button-light-color" value="{{ getSettings('--button-light-color',true) }}" onchange=loadButton(this) data-target="light">
                    </div>
                </div>
                <div class="section">
                    <div class="form-group">
                        <label for="">Dark Button Background</label>
                        <input type="color" id="--button-dark-bg-color" value="{{ getSettings('--button-dark-bg-color',true) }}" onchange=loadButton(this) data-target="dark">
                    </div>
                    <div class="form-group">
                        <label for="">Dark Button Text</label>
                        <input type="color" id="--button-dark-color" value="{{ getSettings('--button-dark-color',true) }}" onchange=loadButton(this) data-target="dark">
                    </div>
                </div>
            </div>

            <div class="button-container">
                <button class="button shadow click-shadow red" id="buttons_clear">Clear</button>
                <button class="button shadow click-shadow green" id="buttons_save">Save</button>
                {{-- <button class="button shadow click-shadow gray">Back</button> --}}
            </div>
        </div>

        <div class="miscellaneous" id="miscellaneous">
            
        </div>
    </div>   

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