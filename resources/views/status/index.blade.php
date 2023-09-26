@extends('default.index')
@section('content')
<div class="status-index">
    <h2>Status Index</h2>

    <div class="controls">
        <div class="form-group stretch">
            <label for="search" >Search Status By Name</label>
            <input type="text" id="search" name="search" placeholder="search status by name" class="text-field" onkeyup="search()">
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

        @can('Statuses Create')            
        <div class="form-group">
            <a href="{{ route('statuses.create') }}" class="button shadow click-shadow success">Create</a>
        </div>
        @endcan

        <span id="controls_toggle" class="controls-toggle" title="Show Control Panel"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m480-320 160-160-160-160-56 56 64 64H320v80h168l-64 64 56 56Zm0 240q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></span>
    </div>

    <div class="table-container">       
        {{ $statuses->links() }}

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($statuses as $status)
                    <tr data-href="{{ route('statuses.show',$status->id) }}" class="clickable">
                        <td class="right">{{ $loop->iteration }}</td>
                        <td>{{ $status->name }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3">
                        {{ $statuses->total().' rows of data returned' }}
                    </td>
                </tr>
            </tfoot>
        </table>

        {{ $statuses->links() }}        
    </div>
</div>

@push("CSS")
    <link rel="stylesheet" href="{{ asset('css/status/index.css') }}">
@endpush

@push("JS")
    <script src="{{ asset('js/status/index.js') }}"></script>

    @if (Session::has('status_deleted'))
        <script>
            toastr.success("{!! Session::pull('status_deleted') !!}");
        </script>
    @endif
@endpush

@endsection
