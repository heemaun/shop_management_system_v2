@extends('default.index')
@section('content')
<div class="purchase-index">
    <h2>Purchase Index</h2>

    <div class="controls">
        <div class="form-group stretch">
            <label for="search" >Search Purchase By Name</label>
            <input type="text" id="search" name="search" placeholder="search purchase by name" class="text-field" onkeyup="search()">
        </div>

        <div class="form-group">
            <label for="Status_id" >Select A Status</label>
            <select id="status_id" name="status_id" onchange="search()">
                <option value="All">Select a option</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ ($status->id == getStatusID('Active')) ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="row_count">Item Count</label>
            <select id="row_count" name="row_count" onchange="search()">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
            </select>
        </div>

        @can('Purchases Create')            
        <div class="form-group">
            <a href="{{ route('purchases.create') }}" class="button shadow click-shadow success">Create</a>
        </div>
        @endcan

        <span id="controls_toggle" class="controls-toggle" title="Show Control Panel"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m480-320 160-160-160-160-56 56 64 64H320v80h168l-64 64 56 56Zm0 240q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></span>
    </div>

    <div class="table-container">       
        {{ $purchases->links() }}

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Status</th>
                    <th>Name</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($purchases as $purchase)
                    <tr data-href="{{ route('purchases.show',$purchase->id) }}" class="clickable">
                        <td class="right">{{ $loop->iteration }}</td>
                        <td>{{ $purchase->status->name }}</td>
                        <td>{{ $purchase->name }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3">
                        {{ $purchases->total().' rows of data returned' }}
                    </td>
                </tr>
            </tfoot>
        </table>

        {{ $purchases->links() }}        
    </div>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/purchase/index.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/purchase/index.js') }}"></script>

    @if (Session::has('purchase_deleted'))
        <script>
            toastr.success("{!! Session::pull('purchase_deleted') !!}");
        </script>
    @endif
@endpush

@endsection
