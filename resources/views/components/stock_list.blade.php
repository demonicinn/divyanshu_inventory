<div class="col-12">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-4">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Vehicle Number</th>
                        <th>Issue Date</th>
                        <th>Issue Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockData as $data)
                    <tr class="align-middle">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $data->vehicle_number }}</td>
                        <td>{{ $data->issue_date }}</td>
                        <td>{{ $data->issue_time }}</td>
                        <td>
                            <a href="{{ route('ab.inventory.pdf', $data->id) }}" class="btn btn-danger btn-sm">Generate PDF</a>
                            <a href="{{ route('ab.inventoryInword.show', $data->id) }}" class="btn btn-primary btn-sm">Details</a>
                            {{-- <button class="btn btn-warning btn-sm" wire:click="editShowModal('{{ $data->id }}')" data-bs-toggle="modal" data-bs-target="#modalFormVisible">Edit</button> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>