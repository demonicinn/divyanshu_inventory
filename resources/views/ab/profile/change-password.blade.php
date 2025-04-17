@extends('layouts.ab')
@section('title', 'Change Password')
@section('content')

<div class="col-6">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Change Password</div>
        </div>
        {{ html()->form('POST', route('ab.profile.password.update'))->open() }}
        <div class="card-body">
            <div class="mb-3">
                <label for="current-password" class="form-label">Current Password</label>
                {{ html()->password('current-password')->class('form-control'. ($errors->has('current-password') ? ' is-invalid' : ''))->placeholder('') }}
                {!! $errors->first('current-password', '<span class="help-block mb-1">:message</span>') !!}
            </div>
            <div class="mb-3">
                <label for="new-password" class="form-label">New Password</label>
                {{ html()->password('new-password')->class('form-control'. ($errors->has('new-password') ? ' is-invalid' : ''))->placeholder('') }}
                {!! $errors->first('new-password', '<span class="help-block mb-1">:message</span>') !!}
            </div>
            <div class="mb-3">
                <label for="new-password_confirmed" class="form-label">Confirm New Password</label>
                {{ html()->password('new-password_confirmed')->class('form-control'. ($errors->has('new-password_confirmed') ? ' is-invalid' : ''))->placeholder('') }}
                {!! $errors->first('new-password_confirmed', '<span class="help-block mb-1">:message</span>') !!}
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
</div>

@endsection
