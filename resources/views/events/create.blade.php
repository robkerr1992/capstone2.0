@extends('layouts.master')

@section('content')
@if(Auth::check())
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Add an event</h4>
            <form method="POST" action="{{ action('EventsController@store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input hidden name="bar_id" value="{{ $id }}">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Event Name">
                    @include('forms.error', ['field' => 'title'])
                </div>
                <div class="form-group">
                    <input type="datetime-local" min="" class="form-control" name="date" id="date" placeholder="Date (yyyy-mm-dd)">
                    @include('forms.error', ['field' => 'date'])
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" id="content" placeholder="Description"></textarea>
                    @include('forms.error', ['field' => 'content'])
                </div>
                <div class="form-group">
                    <label for="image">Add an Image</label>
                    <input type="file" id="image" name="image" placeholder="Image">
                </div>
                <button type="submit" class ="btn btn-primary pull-right">Create Event</button>
            </form>
        </div>
    </div>
    @else
    <div hidden>{!! redirect('auth/login') !!}</div>
@endif
@stop


