@extends('default.index')
@section("content")
<div class="status-edit">
    <form action="{{ route('statuses.update',$status->id) }}" method="POST" id="status_edit_form">
        @csrf
        @method("PUT")

        <legend>Update Status</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter status name" required autocomplete="off" value="{{ $status->name }}">
            <span id="name_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow danger" type="button">Clear All</button>
            <div>
                <button class="button shadow click-shadow primary" type="submit">update</button>
                <a href="{{ route('statuses.show',$status->id) }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/status/edit.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/status/edit.js') }}"></script>
@endpush

@endsection