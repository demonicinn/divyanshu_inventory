@php
    $submitButton = 'Create';
    if(request()->segment(3) != 'create'){
        $submitButton = 'Update';
    }
@endphp



<div class="card-body">
    <div class="mb-3">
        <label class="form-label">Name</label>
        {{ html()->text('name')->class('form-control'. ($errors->has('name') ? ' is-invalid' : '')) }}
        {!! $errors->first('name', '<span class="help-block mb-1">:message</span>') !!}
    </div>

    <div class="mb-3">
        <label class="form-label">Address</label>
        {{ html()->text('address')->class('form-control'. ($errors->has('address') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('address', '<span class="help-block mb-1">:message</span>') !!}
    </div>

    <div class="mb-3">
        <label class="form-label">Contact Number</label>
        {{ html()->number('number')->class('form-control'. ($errors->has('number') ? ' is-invalid' : ''))->placeholder('') }}
        {!! $errors->first('number', '<span class="help-block mb-1">:message</span>') !!}
    </div>

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