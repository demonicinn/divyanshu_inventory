@extends('layouts.ab')
@php $title = ucwords($stock->type).' Details'; @endphp
@section('title', $title)
@section('content')


<div class="col-12">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <p><b>Truck Number:</b> {{ $stock->vehicle_number }}</p>
                    <p><b>Date:</b> {{ $stock->issue_date }} - {{ date('h:ia', strtotime($stock->issue_time)) }}</p>
                </div>
                <div class="col-4">
                    <div class="float-end">
                        <a href="{{ route('ab.inventory.pdf', $stock->id) }}" class="btn btn-danger btn-sm">Generate PDF</a>

                        <a href="{{ route('ab.'. $stock->type) }}" class="btn btn-warning btn-sm"><i
                        class="nav-icon bi bi-arrow-left"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Product</th>
                        <th>Units</th>
                        <th>Kg</th>
                        {{-- <th>Price</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stock->stockProducts as $i => $data)
                    <tr class="align-middle">
                        <td>{{ $i+ 1 }}.</td>
                        <td>{{ $data->product->name }}</td>
                        <td>{{ $data->units }}</td>
                        <td>{{ $data->kg }}</td>
                        {{-- <td>{{ $data->price }}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection