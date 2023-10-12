@extends('default.index')
@section('content')
    <div class="sell-show">
        <div class="top">
            <h2>Sell Information</h2>
    
            <div class="button-container">
                <a href="{{ route('sells.create') }}" class="button shadow click-shadow primary">Add New</a>
                <a href="{{ route('sells.index') }}" class="button shadow click-shadow secondary">Back</a>
                @can('Sells Edit')
                <a href="{{ route('sells.edit', $sell->id) }}" class="button shadow click-shadow success">Edit</a>                    
                @endcan
                @can('Sells Delete')
                <button type="button" id="delete_trigger" class="button shadow click-shadow danger">Delete</button>                    
                @endcan
            </div>
        </div>
        

        <div class="infos">
            

            <div class="info">
                <label for="status" >Customer Name:</label>
                <span class="data">{{ $sell->customer->name }}</span>
            </div>

            <div class="info">
                <label for="status" >Date:</label>
                <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($sell->created_at)) }}</span>
            </div>            
        </div> 
        
        <div class="sell-orders">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Units</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach ($sell->sellOrders as $so)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $so->product->name }}</td>
                                <td>{{ $so->units }}</td>
                                <td>{{ $so->price }}</td>
                                <td>{{ $so->discount }}</td>
                                <td>{{ $so->units * $so->price - $so->discount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
    
                    <tfoot>
                        <tr>
                            <td colspan="4" rowspan="3">{{ 'Unit Count: '.$sell->units.' Item Count '.count($sell->sellOrders) }}</td>
                            <td>Sub-Total</td>
                            <td>{{ $sell->sub_total }}</td>
                        </tr>
    
                        <tr>
                            <td>Discount</td>
                            <td>{{ $sell->discount }}</td>
                        </tr>
    
                        <tr>
                            <td>Total</td>
                            <td>{{ $sell->sub_total - $sell->discount }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="infos">
                <div class="sides">
                    <div class="info">
                        <label for="status" >Sell Status:</label>
                        <span class="data">{{ $sell->status->name }}</span>
                    </div>
                </div>

                <div class="sides">
                    <div class="info">
                        <label for="status" >Last Modified By:</label>
                        <span class="data">{{ $sell->admin->name }}</span>
                    </div> 

                    <div class="info">
                        <label for="status" >Last Modified At:</label>
                        <span class="data date">{{ date('d-M-Y h:i:s A', strtotime($sell->updated_at)) }}</span>
                    </div>
                </div>                              
            </div>
        </div>
    </div>

    @can('Sells Delete')
    <div id="sell_delete_div" class="sell-delete">
        <form action="{{ route('sells.destroy', $sell->id) }}" method="POST" id="delete_form">
            @csrf
            @method('DELETE')

            <legend>Delete Sell</legend>

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
        <link rel="stylesheet" href="{{ asset('css/sell/show.css') }}">
    @endpush

    @push('JS')
        <script src="{{ asset('js/sell/show.js') }}"></script>
        @if (Session::has('sell_added'))
            <script>
                toastr.success("{!! Session::pull('sell_added') !!}");
            </script>
        @endif

        @if (Session::has('sell_updated'))
            <script>
                toastr.success("{!! Session::pull('sell_updated') !!}");
            </script>
        @endif
    @endpush

@endsection
