@extends('layouts.master')

@section('content')
    <div class="col-xs-8 col-xs-offset-2">
        <h4 class="modal-title">Change your password</h4>
        <form method="POST" action="{{ action('UserController@updatePassword', $user->id) }}">
            {{ method_field('PUT') }}
            {!! csrf_field() !!}
            <div class="form-group">
                <input
                        type="password"
                        class="form-control"
                        name="password"
                        id="password"
                        placeholder="Enter a new password">
                <small>Enter a password between 6 and 60 characters</small>
                @include('forms.error', ['field' => 'password'])
            </div>
            <div class="form-group">
                <input
                        type="password"
                        class="form-control"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Verify password">
                @include('forms.error', ['field' => 'password_confirmation'])
            </div>
            <div class="col-md-6"></div>
            <div class="row form-group">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@stop
