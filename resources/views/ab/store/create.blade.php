@extends('layouts.ab')
@section('title', 'Add Store')
@section('content')

<div class="col-6">
    <div class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">Add New Store</div>
            <a href="{{ route('ab.store') }}" class="btn btn-warning btn-sm float-end"><i
                    class="nav-icon bi bi-arrow-left"></i></a>
        </div>

        {{ html()->form('POST', route('ab.store.store'))->acceptsFiles()->open() }}

        @include('ab.store.form')

        {{ html()->form()->close() }}
    </div>
</div>

@endsection
