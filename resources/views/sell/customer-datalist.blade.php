@foreach ($customers as $customer)
    <option data-id="{{ $customer->id }}" data-name="{{ $customer->name }}">{{ $customer->name }}</option>
@endforeach
