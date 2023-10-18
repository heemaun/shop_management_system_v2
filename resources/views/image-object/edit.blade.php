@extends('default.index')
@section("content")
<div class="image-object-edit">
    <form action="{{ route('image-objects.update',$image-object->id) }}" method="POST" id="image_object_edit_form">
        @csrf
        @method("PUT")

        <legend>Update Image</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter image-object name" required autocomplete="off" value="{{ $image-object->name }}">
            <span id="name_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="name" >Balance</label>
            <input type="text" name="balance" id="balance" class="text-field" placeholder="enter image-object balance" required autocomplete="off" value="{{ $image-object->balance }}">
            <span id="balance_error" class="error"></span>
        </div>
        
        <div class="form-group">
            <label for="status_id" >Status</label>
            <select name="status_id" id="status_id" class="select" required>
                <option value="">Select a status</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ ($status->id == $image-object->status_id) ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
            <span id="gender_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow danger" type="button">Clear All</button>
            <div>
                <button class="button shadow click-shadow primary" type="submit">update</button>
                <a href="{{ route('image-objects.show',$image-object->id) }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/image-object/edit.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/image-object/edit.js') }}"></script>
@endpush

@endsection