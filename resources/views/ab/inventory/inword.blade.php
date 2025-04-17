@php
    $title = 'Inword';
@endphp

@extends('layouts.ab')
@section('title', $title)
@section('content')

    @livewire('stock', ['title' => $title, 'type' => 'inword'])

@endsection