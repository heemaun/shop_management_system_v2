@if (count($categories) == 0)

<span class="no-data-found">No Data Found!</span>

@else

{{ $categories->links() }}

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Name</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($categories as $category)
            <tr data-href="{{ route('categories.show',$category->id) }}" class="clickable">
                <td class="right">{{ $loop->iteration }}</td>
                <td>{{ $category->status->name }}</td>
                <td>{{ $category->name }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3">
                {{ $categories->total().' rows of data returned' }}
            </td>
        </tr>
    </tfoot>
</table>

{{ $categories->links() }}   

@endif