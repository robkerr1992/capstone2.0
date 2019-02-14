@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Update your event</h4>
            <form method="POST" action="{{ action('EventsController@update', $event->id) }}" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="title" id="title" value="{{ $event->title }}">
                    @include('forms.error', ['field' => 'title'])
                </div>
                <div class="form-group">
                    <input type="datetime-local" class="form-control" name="date" id="date" value="<?= str_replace(" ", "T", $event->date->format('Y-m-d H:i')) ?>">
                    @include('forms.error', ['field' => 'date'])
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" id="content" placeholder="Description">{{ $event->content }}</textarea>
                    @include('forms.error', ['field' => 'content'])
                </div>
                <div class="form-group">
                    <label for="image">Select a different image</label>
                    <input type="file" id="image" name="image" placeholder="Image">
                </div>
                <button type="submit" class ="btn btn-primary pull-right">Update Event</button>
            </form>
        </div>
    </div>
@stop