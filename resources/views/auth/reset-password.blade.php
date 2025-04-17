@extends('layouts.auth')
@section('content')
<div class="row">
	<div class="col-lg-6 d-none d-lg-block ">
		<!-- slider html here -->
		@include('auth.slider')
	</div>

	<div class="col-lg-6">
		<div class="p-5 pt-100">
			<div class="text-center">
				<h1 class="h4 h4_tittle ">Reset Password</h1>
				<p class="mb-4 p_text">Automate demand planning, category management, and the 
				end-to-end process for the entire operation. </p>
			</div>
			
			@include('layouts.alerts')
			
			{!! Form::open(['route' => 'password.update', 'class'=>'user']) !!}
				<input type="hidden" name="token" value="{{ request()->route('token') }}">
				<div class="form-outline{!! ($errors->has('email') ? ' has-error' : '') !!}">
					{!! Form::email('email', request()->email ?? null, ['class' => 'form-control'.($errors->has('email') ? ' is-invalid' : '')]) !!}
					{!! Form::label('email','Email Address', ['class' => 'form-label']) !!}
					{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
				</div> 
				
				<div class="form-outline{!! ($errors->has('password') ? ' has-error' : '') !!}">
					<input type="password" id="password" name="password" class="form-control{!! ($errors->has('password') ? ' is-invalid' : '') !!}" />
					{!! Form::label('password','Password', ['class' => 'form-label']) !!}
					<a class="cross_eyes" id="cross_eyes_pass" data-target="password"><img id="eyes_pass" src="{{ asset('assets/img/cros_eyes.png') }}"></a>
					{!! $errors->first('password', '<span class="help-block">:message</span>') !!}
				</div>
				
				<div class="form-outline{!! ($errors->has('password_confirmation') ? ' has-error' : '') !!}">
					<input type="password" id="password_confirmation" name="password_confirmation" class="form-control{!! ($errors->has('password_confirmation') ? ' is-invalid' : '') !!}"/>
					{!! Form::label('password_confirmation','Confirm Password', ['class' => 'form-label']) !!}
					<a class="cross_eyes" id="cross_eyes_con" data-target="password_confirmation"><img id="eyes_con_pass" src="{{ asset('assets/img/cros_eyes.png') }}"></a>
					{!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
				</div>	
				
				<div class="form-group btn_login_sign pt-5">
					<button class="btn btn-danger btn-user btn_s">
						{{__ ('Reset Password') }}
					</button>
				</div>				
				
			{!! Form::close() !!}
			
		</div>
	</div>
</div>
@endsection