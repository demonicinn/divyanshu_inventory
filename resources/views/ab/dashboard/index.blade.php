@extends('layouts.ab')
@section('title', 'Dashboard')
@section('content')

<div class="app-content-header">
    <div class="app-content">
        <div class="row">
            
            @foreach($getUserStores as $store)
            <div class="col-12 col-sm-6 col-md-4">
                <a href="{{ route('ab.store.select.dashboard', $store->id) }}" class="info-box">
                    <span class="info-box-icon text-bg-success shadow-sm">
                        <i class="bi bi-cart-fill"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ $store->name }}
                            @if($user->store_id == $store->id)
                            <span class="badge text-bg-info">Current</span>
                            @endif
                        </span>
                        <span class="info-box-number">
                            Products: {{ $store->products_count }}
                        </span>
                    </div>
                </a>
            </div>
            @endforeach
            
        </div>
    </div>
</div>

@endsection

@section('style')
<style>
a.info-box {
    text-decoration: none !important;
}
</style>
@endsection