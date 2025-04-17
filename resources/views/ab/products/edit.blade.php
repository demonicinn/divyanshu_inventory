@extends('layouts.ab')
@section('title', 'Edit Product')
@section('content')

<div class="col-6">
    <div class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">Edit Product</div>

            <div class="float-end">
                <a href="{{ route('ab.products.show', $product->id) }}" class="btn btn-warning btn-sm"><i
                        class="nav-icon bi bi-arrow-left"></i></a>
            </div>
        </div>

        {{ html()->model($product)->form('PATCH', route('ab.products.update', $product->id))->acceptsFiles()->open() }}
        
        @include('ab.products.form')

        {{ html()->form()->close() }}
    </div>
</div>

@endsection
