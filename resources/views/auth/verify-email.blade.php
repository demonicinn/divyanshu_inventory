@extends('layouts.auth')

@section('content')
<div class="login-page-wrapper auth-padd">
	<div class="container">
		<div class="blue-page-heading">
			<h2>{{ __('Verify Your Email Address') }}</h2>
		</div>
		<div class="Form-Wrapper">
		
			@if (session('resent'))
				<div class="alert alert-success" role="alert">
					{{ __('A fresh verification link has been sent to your email address.') }}
				</div>
			@endif
			
			{{ __('Before proceeding, please check your email for a verification link.') }}
			{{ __('If you did not receive the email') }},
			<form class="d-inline" method="POST" action="{{ route('verification.send') }}">
				@csrf
				<button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
			</form>
			
		</div>
	</div>
</div>
@endsection