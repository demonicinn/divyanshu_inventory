@extends('layouts.auth')
@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <a href="" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0"><b>Admin</b>Login</h1>
            </a>
        </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            {{ html()->form('POST', '/login')->open() }}
            <div class="input-group mb-1">
                <div class="form-floating">
                    {{ html()->email('email')->class('form-control'. ($errors->has('email') ? ' is-invalid' : ''))->placeholder('') }}
                    <label for="loginEmail">Email</label>
                </div>
                <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            </div>
            {!! $errors->first('email', '<span class="help-block mb-1">:message</span>') !!}

            <div class="input-group mb-1">
                <div class="form-floating">
                    {{ html()->password('password')->class('form-control'. ($errors->has('password') ? ' is-invalid' : ''))->placeholder('') }}
                    <label for="loginPassword">Password</label>
                </div>
                <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            </div>
            {!! $errors->first('password', '<span class="help-block mb-1">:message</span>') !!}

            <div class="row">
                <div class="col-4">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}

        </div>
    </div>
</div>
@endsection
