@extends('layouts.ab')
@section('title', 'Store Details')
@section('content')
{{-- 
<div class="col-6">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Store Details</h3>
            
            <div class="float-end">

                <a href="{{ route('ab.store.edit', $store->id) }}"
                    class="btn btn-warning btn-sm"><i class="nav-icon bi bi-pencil-square"></i></a>

                <a data-method="Delete" data-confirm="Are you sure to delete?" href="{{ route('ab.store.destroy', $store->id) }}"
                        class="btn btn-danger btn-sm"><i class="nav-icon bi bi-trash3"></i></a>

                <a href="{{ route('ab.store') }}"
                    class="btn btn-warning btn-sm"><i class="nav-icon bi bi-arrow-left"></i></a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="px-2">
                <div class="d-flex border-top py-2 px-1">
                    <div class="col-12">
                        <div class="text-truncate"><b>Name:</b> {{ $store->name }}</div>
                        <div class="text-truncate"><b>Contact Number:</b> {{ $store->number }}</div>
                        <div class="text-truncate"><b>Address:</b> {{ $store->address }}</div>
                        <div class="text-truncate"><b>Status:</b> {{ statusValue($store->status) }}</div>


                        <div class="text-truncate"><b>Attachments:</b></div>

                        @if ($store->files)
                            @foreach (json_decode($store->files) as $i => $file)
                                <div class="btn-group mb-2" role="group" aria-label="Button group with nested dropdown">
                                    <a target="_blank" class="btn btn-outline-primary" href="{{ asset('storage/files/'.$file) }}">Attachment {{$i+1}}</a>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="col-12">
    <div class="card card-primary card-outline mb-4">
        
        @livewire('category', ['storeId' => $store->id])

    </div>
</div> --}}

@endsection
