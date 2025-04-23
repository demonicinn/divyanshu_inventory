@extends('layouts.ab')
@section('title', 'Products')
@section('content')


<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-header">

            <div class="row">
                <div class="col-4">
                    @include('components.search')
                </div>
                <div class="col-8">
                    <a href="{{ route('ab.products.create') }}" class="btn btn-primary btn-sm float-end">Add
                        New Product</a>
                </div>
            </div>


        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>SKU</th>
                        <th>Name</th>
                        {{-- <th>Unit</th> --}}
                        {{-- <th>Kg</th> --}}
                        {{-- <th>Price</th> --}}
                        <th>Current Stock (Kg)</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($products as $data)
                        <tr class="align-middle">
                            <td>{{ $products->firstItem() + $loop->index }}</td>
                            <td>{{ $data->sku }}</td>
                            <td><a href="{{ route('ab.products.show', $data->id) }}">{{ $data->name }}</a></td>
                            {{-- <td>{{ $data->unit }}</td> --}}
                            {{-- <td>{{ $data->kg }}</td> --}}
                            {{-- <td>{{ priceDecimal($data->price) }}</td> --}}
                            <td>{{ isset($data->productCurrentStock) ? $data->productCurrentStock->new_stock : 0 }}</td>
                            <td>{{ statusValue($data->status) }}</td>
                            <td>
                                <a href="{{ route('ab.products.show', $data->id) }}"
                                    class="btn btn-primary btn-sm">Details</a>

                                <a href="{{ route('ab.products.edit', $data->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <a data-method="Delete" data-confirm="Are you sure to delete?" href="{{ route('ab.products.destroy', $data->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            {{ $products->links() }}
        </div>

    </div>
</div>

@endsection
