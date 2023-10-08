@extends('default.index')
@section('content')
<div class="sell-index">
    <h2>Sell Index</h2>

    <div class="controls">
        <div class="form-group stretch">
            <label for="customer_id">Customer Name</label>
            <input type="text" id="customer_name" name="customer_name" list="customer_list" placeholder="search for customer name" class="text-field" onchange="search()">
            {{-- <input type="hidden" id="customer_id" name="customer_id" onchange="search()"> --}}
            <datalist id="customer_list">
                @foreach ($customers as $customer)
                    <option data-id="{{ $customer->id }}" data-name="{{ $customer->name }}">{{ $customer->name }}</option>
                @endforeach
            </datalist>
        </div>

        <div class="form-group">
            <label for="from_date">From Date</label>
            <input type="date" id="from_date" class="text-field date" min="{{ $fromDate }}" value="{{ $fromDate }}" onchange="search()">
        </div>
        
        <div class="form-group">
            <label for="to_date">To Date</label>
            <input type="date" id="to_date" class="text-field date" max="{{ $toDate }}" value="{{ $toDate }}" onchange="search()">
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

        @can('Sells Create')            
        <div class="form-group">
            <a href="{{ route('sells.create') }}" class="button shadow click-shadow success">Create</a>
        </div>
        @endcan

        <span id="controls_toggle" class="controls-toggle" title="Show Control Panel"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m480-320 160-160-160-160-56 56 64 64H320v80h168l-64 64 56 56Zm0 240q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></span>
    </div>

    <div class="table-container">       
        {{ $sells->links() }}

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                    <th>Units</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sells as $sell)
                    <tr data-href="{{ route('sells.show',$sell->id) }}" class="clickable">
                        <td class="right">{{ $loop->iteration }}</td>
                        <td class="date">{{ date('d-M-Y h:i:s a',strtotime($sell->created_at)) }}</td>
                        <td>{{ $sell->customer->name }}</td>
                        <td>{{ $sell->status->name }}</td>
                        <td>{{ $sell->units }}</td>
                        <td>{{ $sell->sub_total - $sell->discount }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="6">
                        {{ $sells->total().' rows of data returned' }}
                    </td>
                </tr>
            </tfoot>
        </table>

        {{ $sells->links() }}        
    </div>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/sell/index.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/sell/index.js') }}"></script>

    @if (Session::has('sell_deleted'))
        <script>
            toastr.success("{!! Session::pull('sell_deleted') !!}");
        </script>
    @endif
@endpush

@endsection
