@extends('layouts.ab')
@section('title', 'Add Product')
@section('content')

<div class="col-6">
    <div class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">Add New Product</div>
            <a href="{{ route('ab.products') }}" class="btn btn-warning btn-sm float-end"><i
                    class="nav-icon bi bi-arrow-left"></i></a>
        </div>

        {{ html()->form('POST', route('ab.products.store'))->acceptsFiles()->open() }}

        @include('ab.products.form')

        {{ html()->form()->close() }}
    </div>
</div>

@endsection
