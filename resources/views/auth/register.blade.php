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
				<h1 class="h4 h4_tittle ">Create an Account</h1>
				<p class="mb-4 p_text">Automate demand planning, category management, and the
				end-to-end process for the entire operation. </p>
			</div>
			
			@include('layouts.alerts')
			
			{!! Form::open(['route' => 'register', 'method'=>'post', 'class'=>'user']) !!}
				
				<div class="form-outline{!! ($errors->has('first_name') ? ' has-error' : '') !!}">
					{!! Form::text('first_name', request()->first_name ?? null, ['class' => 'form-control'.($errors->has('first_name') ? ' is-invalid' : '')]) !!}
					{!! Form::label('first_name','First Name', ['class' => 'form-label']) !!}
					{!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
				</div>
				
				<div class="form-outline{!! ($errors->has('last_name') ? ' has-error' : '') !!}">
					{!! Form::text('last_name', request()->last_name ?? null, ['class' => 'form-control'.($errors->has('last_name') ? ' is-invalid' : '')]) !!}
					{!! Form::label('last_name','Last Name', ['class' => 'form-label']) !!}
					{!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
				</div> 
				
				<div class="form-outline{!! ($errors->has('email') ? ' has-error' : '') !!}">
					{!! Form::email('email', request()->email ?? null, ['class' => 'form-control'.($errors->has('email') ? ' is-invalid' : '')]) !!}
					{!! Form::label('email','Email', ['class' => 'form-label']) !!}
					{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
				</div>
				
				<div class="form-outline{!! ($errors->has('password') ? ' has-error' : '') !!}">
					<input type="password" id="password" name="password" class="form-control{!! ($errors->has('password') ? ' is-invalid' : '') !!}" />
					{!! Form::label('password','Password', ['class' => 'form-label']) !!}
					<a class="cross_eyes" id="cross_eyes_pass" data-target="password"><img id="eyes_pass" src="{{ asset('assets/img/cros_eyes.png') }}" data-target="password"></a>
					{!! $errors->first('password', '<span class="help-block">:message</span>') !!}
				</div>
				
				<div class="form-outline{!! ($errors->has('password_confirmation') ? ' has-error' : '') !!}">
					<input type="password" id="password_confirmation" name="password_confirmation" class="form-control{!! ($errors->has('password_confirmation') ? ' is-invalid' : '') !!}"/>
					{!! Form::label('password_confirmation','Confirm Password', ['class' => 'form-label']) !!}
					<a class="cross_eyes" id="cross_eyes_con" data-target="password_confirmation"><img id="eyes_con_pass" src="{{ asset('assets/img/cros_eyes.png') }}" data-target="password_confirmation"></a>
					{!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
				</div>				
				
				<div class="custom-control custom-checkbox box_register_check pt-2">
					<input type="checkbox" class="custom-control-input" id="customCheck" name="terms">
					<label class="custom-control-label" for="customCheck">By creating account you agree to SaavorConnect <a href="{{ route('terms-conditions') }}">Terms & Conditions, </a><a href="{{ route('privacy-policy') }}">Privacy Policy</a> and <a href="{{ route('eula') }}">EULA</a></label>
					{!! $errors->first('terms', '<span class="help-block">:message</span>') !!}
				</div>
									
				<div class="form-group btn_login_sign pt-5">
					<button type="submit" class="btn btn-danger btn-user btn_s">
						{{__ ('Sign Up') }}
					</button>
				</div>
				
				
			{!! Form::close() !!}
			
			<div class="text-center pt-3">
				{{__ ("Already have an account?") }} <a class="red_link" href="{{ route('login') }}"><b>{{__ ("Sign In") }}</b></a>
			</div>
		</div>
	</div>
</div>
@endsection