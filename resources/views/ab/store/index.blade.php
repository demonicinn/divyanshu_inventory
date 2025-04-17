@extends('layouts.ab')
@section('title', 'Store')
@section('content')


<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-header">

            <div class="row">
                <div class="col-4">
                    @include('components.search')
                </div>
                <div class="col-8">
                    <a href="{{ route('ab.store.create') }}" class="btn btn-primary btn-sm float-end">Add
                        New Store</a>
                </div>
            </div>


        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Store Name</th>
                        <th>Contact Number</th>
                        <th>Store Address</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($stores as $data)
                        <tr class="align-middle">
                            <td>{{ $stores->firstItem() + $loop->index }}</td>
                            <td><a href="{{ route('ab.store.show', $data->id) }}">{{ $data->name }}</a></td>
                            <td>{{ $data->number }}</td>
                            <td>{{ $data->address }}</td>
                            <td>{{ statusValue($data->status) }}</td>
                            <td>

                                <a href="{{ route('ab.store.edit', $data->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <a data-method="Delete" data-confirm="Are you sure to delete?" href="{{ route('ab.store.destroy', $data->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            {{ $stores->links() }}
        </div>

    </div>
</div>

@endsection
