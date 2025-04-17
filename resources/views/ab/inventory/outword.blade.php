@php
    $title = 'Outword';
@endphp

@extends('layouts.ab')
@section('title', $title)
@section('content')

    @livewire('stock', ['title' => $title, 'type' => 'outword'])

@endsection