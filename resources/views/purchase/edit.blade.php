@extends('default.index')
@section("content")
<div class="purchase-edit">
    <form action="{{ route('purchases.update',$purchase->id) }}" method="POST" id="purchase_edit_form">
        @csrf
        @method("PUT")

        <legend>Update Purchase</legend>

        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" name="name" id="name" class="text-field" placeholder="enter purchase name" required autocomplete="off" value="{{ $purchase->name }}">
            <span id="name_error" class="error"></span>
        </div>

        <div class="form-group">
            <label for="name" >Balance</label>
            <input type="text" name="balance" id="balance" class="text-field" placeholder="enter purchase balance" required autocomplete="off" value="{{ $purchase->balance }}">
            <span id="balance_error" class="error"></span>
        </div>
        
        <div class="form-group">
            <label for="status_id" >Status</label>
            <select name="status_id" id="status_id" class="select" required>
                <option value="">Select a status</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ ($status->id == $purchase->status_id) ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
            <span id="gender_error" class="error"></span>
        </div>

        <div class="button-container">
            <button class="button shadow click-shadow danger" type="button">Clear All</button>
            <div>
                <button class="button shadow click-shadow primary" type="submit">update</button>
                <a href="{{ route('purchases.show',$purchase->id) }}" class="button shadow click-shadow secondary">Back</a>
            </div>
        </div>
    </form>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/purchase/edit.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/purchase/edit.js') }}"></script>
@endpush

@endsection