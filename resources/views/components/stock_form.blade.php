<div class="col-12">
    <div class="card card-primary card-outline mb-4">
        <form>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Vehicle Number</label>
                        <input type="text" wire:model="vehicle_number" class="form-control">
                        {!! $errors->first('vehicle_number', '<span class="help-block mb-1">:message</span>') !!}
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Issue Date</label>
                        <input type="date" wire:model="issue_date" class="form-control">
                        {!! $errors->first('issue_date', '<span class="help-block mb-1">:message</span>') !!}
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Issue Time</label>
                        <input type="time" wire:model="issue_time" class="form-control">
                        {!! $errors->first('issue_time', '<span class="help-block mb-1">:message</span>') !!}
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Product</th>
                            <th>Stock</th>
                            <th>Units</th>
                            <th>Kg</th>
                            {{-- <th>Price</th> --}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fieldsArray as $i => $fields)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>
                                <select class="product_select" data-id="{{ $i }}" wire:model="fieldsArray.{{ $i }}.product_id">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                </br>{!! $errors->first('fieldsArray.'.$i.'.product_id', '<span class="help-block mb-1">Field is required</span>') !!}
                            </td>
                            <td>{{ $fieldsArray[$i]['stock'] }}</td>
                            <td>
                                <input type="number" wire:model="fieldsArray.{{ $i }}.units">
                                </br>{!! $errors->first('fieldsArray.'.$i.'.units', '<span class="help-block mb-1">Field is required</span>') !!}
                            </td>
                            <td>
                                <input type="number" wire:model="fieldsArray.{{ $i }}.kg">
                            </br>{!! $errors->first('fieldsArray.'.$i.'.kg', '<span class="help-block mb-1">Field is required</span>') !!}
                            </td>
                            {{-- <td>
                                <input type="number" wire:model="fieldsArray.{{ $i }}.price">
                                </br>{!! $errors->first('fieldsArray.'.$i.'.price', '<span class="help-block mb-1">Field is required</span>') !!}
                            </td> --}}
                            <td>
                            @if($i > 0)
                            <button type="button" class="btn btn-danger btn-sm" wire:click="removeField(`{{ $i }}`)">Remove</button>
                            @endif
                            </td>
                        </tr>
                        @endforeach

                        
                    </tbody>
                </table>


            </div>

            <div class="card-footer">
                <div class="float-end">
                    <button type="button" class="btn btn-primary" wire:click="addFields">Add</button>
                    
                    @if ($modelId)
                        <button type="button" class="btn btn-success" wire:click="update" wire:loading.attr="disabled">Update</button>
                    @else
                        <button type="button" class="btn btn-success" wire:click="create" wire:loading.attr="disabled">Create</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>