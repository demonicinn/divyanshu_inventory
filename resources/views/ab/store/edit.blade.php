@extends('layouts.ab')
@section('title', 'Edit Store')
@section('content')

<div class="col-6">
    <div class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">Edit Store</div>

            <div class="float-end">
                <a href="{{ route('ab.store.show', $store->id) }}" class="btn btn-warning btn-sm"><i
                        class="nav-icon bi bi-arrow-left"></i></a>
            </div>
        </div>

        {{ html()->model($store)->form('PATCH', route('ab.store.update', $store->id))->acceptsFiles()->open() }}
        
        @include('ab.store.form')

        {{ html()->form()->close() }}
    </div>
</div>

@endsection
