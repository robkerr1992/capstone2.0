@extends('layouts.master')

@section('content')
	@if(Auth::check())
		<div hidden>{!! redirect('bars') !!}</div>
	@endif
<div class="row">
	<div class="col-xs-6 col-xs-offset-3">
		<h4 class="modal-title">Log in</h4>
		<form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
			{{ csrf_field() }}
			<div class="form-group">
				<input type="text" class="form-control" name="email" id="email" placeholder="Email">
				@include('forms.error', ['field' => 'email'])
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" id="password" placeholder="Password">
				@include('forms.error', ['field' => 'password'])
			</div>
			<div class="pull-left">
				Not a member? <a href="/auth/register">Sign up!</a>
			</div>
			<button type="submit" class ="btn btn-primary pull-right">Log in</button>
		</form>
	</div>
</div>
@stop