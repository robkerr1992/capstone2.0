@extends('layouts.master')

@section('content')
    <div class="col-xs-8 col-xs-offset-2">
        <h4 class="modal-title">Change your account info</h4>
        <form method="POST" action="{{ action('UserController@update', $user->id) }}" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group">
                <input
                        type="text"
                        class="form-control"
                        name="first_name"
                        id="first_name"
                        placeholder="First name"
                        value="{{ $user->first_name }}">
                @include('forms.error', ['field' => 'first_name'])
            </div>
            <div class="form-group">
                <input
                        type="text"
                        class="form-control"
                        name="last_name"
                        id="last_name"
                        placeholder="Last name"
                        value="{{ $user->last_name }}">
                @include('forms.error', ['field' => 'last_name'])
            </div>
            <div class="form-group">
                <input
                        type="text"
                        class="form-control"
                        name="email"
                        id="email"
                        placeholder="Email"
                        value="{{ $user->email }}">
                @include('forms.error', ['field' => 'email'])
            </div>
            <div class="form-group">
                <label for="image">Add a Profile Picture</label>
                <input type="file" id="image" name="image" placeholder="Image">
            </div>
            <h3><a href="{{ action('UserController@editPassword', $user->id) }}">Change your password</a> </h3>
            <button type="submit" class="btn btn-primary pull-right">Update Info</button>
        </form>
    </div>
@stop