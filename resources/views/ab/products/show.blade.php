@extends('layouts.ab')
@section('title', 'Product Details')
@section('content')

<div class="col-6">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Product Details</h3>
            
            <div class="float-end">

                <a href="{{ route('ab.products.edit', $product->id) }}"
                    class="btn btn-warning btn-sm"><i class="nav-icon bi bi-pencil-square"></i></a>

                <a data-method="Delete" data-confirm="Are you sure to delete?" href="{{ route('ab.products.destroy', $product->id) }}"
                        class="btn btn-danger btn-sm"><i class="nav-icon bi bi-trash3"></i></a>

                <a href="{{ route('ab.products') }}"
                    class="btn btn-warning btn-sm"><i class="nav-icon bi bi-arrow-left"></i></a>
            </div>
        </div>


        <div class="card-body p-0">
            <div class="px-2">
                <div class="d-flex border-top py-2 px-1">
                    <div class="col-12">
                        <div class="text-truncate"><b>Name:</b> {{ $product->name }}</div>
                        <div class="text-truncate"><b>SKU:</b> {{ $product->sku }}</div>
                        <div class="text-truncate"><b>Status:</b> {{ statusValue($product->status) }}</div>

                        <div class="text-truncate"><b>Current Stock (Kg):</b> {{ isset($product->productCurrentStock) ? $product->productCurrentStock->new_stock : 0 }}</div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



@if(count($stockProducts) > 0)
<div class="col-12">
    <div class="card card-primary card-outline mb-4">
        
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Units</th>
                        <th>Kg</th>
                        <th>Current Stock (Kg)</th>
                        <th>Vehicle Number</th>
                        <th>Type</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($stockProducts as $data)
                        <tr class="align-middle">
                            <td>{{ $stockProducts->firstItem() + $loop->index }}</td>
                            <td>{{ $data->units }}</td>
                            <td>{{ $data->kg }}</td>
                            <td>{{ $data->new_stock }}</td>
                            <td>{{ $data->stock->vehicle_number }}</td>
                            <td>{{ ucwords($data->stock->type) }}</td>
                            <td>{{ $data->stock->issue_date }} - {{ date('h:ia', strtotime($data->stock->issue_time)) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            {{ $stockProducts->links() }}
        </div>
        

    </div>
</div>
@endif

@endsection
