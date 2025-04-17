@php
    $submitButton = 'Create';
    if(request()->segment(3) != 'create'){
        $submitButton = 'Update';
    }
@endphp

<div class="card-body">

    <div class="mb-3">
        <label class="form-label">SKU Number</label>
        {{ html()->text('sku')->class('form-control'. ($errors->has('sku') ? ' is-invalid' : '')) }}
        {!! $errors->first('sku', '<span class="help-block mb-1">:message</span>') !!}
    </div>

    <div class="mb-3">
        <label class="form-label">Name</label>
        {{ html()->text('name')->class('form-control'. ($errors->has('name') ? ' is-invalid' : '')) }}
        {!! $errors->first('name', '<span class="help-block mb-1">:message</span>') !!}
    </div>

    {{-- <div class="mb-3">
        <label class="form-label">Unit</label>
        {{ html()->number('unit')->class('form-control'. ($errors->has('unit') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('unit', '<span class="help-block mb-1">:message</span>') !!}
    </div>
    <div class="mb-3">
        <label class="form-label">Kg</label>
        {{ html()->number('kg')->class('form-control'. ($errors->has('kg') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('kg', '<span class="help-block mb-1">:message</span>') !!}
    </div> --}}

    {{-- <div class="mb-3">
        <label class="form-label">Price</label>
        {{ html()->number('price')->class('form-control'. ($errors->has('price') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('price', '<span class="help-block mb-1">:message</span>') !!}
    </div> --}}

    <div class="mb-3">
        <label class="form-label">Files ({{ imagesMimeText() }})</label>
        </br>
        @if (isset($client->files))
            @foreach (json_decode($client->files) as $i => $file)
                <div class="btn-group mb-2 attach{{ $i }}" role="group" aria-label="Button group with nested dropdown">
                    {{ html()->hidden('attachment[]')->value($file) }}
                    <a target="_blank" class="btn btn-outline-primary" href="{{ asset('storage/files/'.$file) }}">Attachment {{$i+1}}</a>
                    <button type="button" onClick="deleteAttachment({{ $i }})" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                </div>
            @endforeach
        @endif

        {{ html()->file('files[]')->class('form-control'. ($errors->has('files[]') ? ' is-invalid' : ''))->accept(env('IMAGE_MIME'))->multiple() }}
        {!! $errors->first('files[]', '<span class="help-block mb-1">:message</span>') !!}
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        {{ html()->select('status')->class('form-control'. ($errors->has('status') ? ' is-invalid' : ''))->options(statusArray()) }}
        {!! $errors->first('status', '<span class="help-block mb-1">:message</span>') !!}
    </div>

</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $submitButton }}</button>
</div>

@section('script')
<script>
    function deleteAttachment(id){
        if(confirm("Are you sure you want to delete this?")){
            $('.btn-group.attach'+id).remove();
        }
        else{
            return false;
        }
    }
</script>
@endsection