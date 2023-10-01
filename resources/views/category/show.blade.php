@extends('default.index')
@section('content')
    <div class="category-show">
        <div class="button-container">
            <a href="{{ route('categories.index') }}" class="button shadow click-shadow secondary">Back</a>
            @can('Categories Edit')
            <a href="{{ route('categories.edit', $category->id) }}" class="button shadow click-shadow success">Edit</a>                    
            @endcan
            @can('Categories Delete')
            <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>                    
            @endcan
        </div>

        <div class="infos">
            <h2>Category Information</h2>

            <div class="info">
                <label for="status" >Status</label>
                <span class="data">{{ $category->status->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified By</label>
                <span class="data">{{ $category->admin->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Name</label>
                <span class="data">{{ $category->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Created At</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($category->created_at)) }}</span>
            </div>

            <div class="info">
                <label for="status" >Last Modified At</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($category->updated_at)) }}</span>
            </div>
        </div>       
    </div>

    @can('Categories Delete')
    <div id="category_delete_div" class="category-delete">
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" id="delete_form">
            @csrf
            @method('DELETE')

            <legend>Delete Category</legend>

            <div class="form-group">
                <label for="password" >Enter Your Password</label>
                <input type="password" id="password" class="text-field" placeholder="enter your password"
                    name="password">
                <span id="password_error" class="error"></span>
            </div>

            <div class="form-group">
                <input type="checkbox" id="permanent" class="">
                <label for="permanent" >Select it if you wanna delete it permanently</label>
            </div>

            <div class="button-container">
                <button type="submit" class="button shadow click-shadow danger">Delete</button>
                <button type="button" class="button shadow click-shadow secondary" id="delete_form_close">Close</button>
            </div>
        </form>
    </div>
    @endcan

    @push('CSS')
        <link rel="stylesheet" href="{{ asset('css/category/show.css') }}">
    @endpush

    @push('JS')
        <script src="{{ asset('js/category/show.js') }}"></script>
        @if (Session::has('category_added'))
            <script>
                toastr.success("{!! Session::pull('category_added') !!}");
            </script>
        @endif

        @if (Session::has('category_updated'))
            <script>
                toastr.success("{!! Session::pull('category_updated') !!}");
            </script>
        @endif
    @endpush

@endsection
