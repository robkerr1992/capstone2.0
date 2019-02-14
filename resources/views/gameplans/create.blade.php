@extends('layouts.master')
@section('content')
    {{--{{dd($bars)}}--}}
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Create a Gameplan</h4>
            <button id="moreStopsButton" class="btn btn-warning">Add Hop-Stop</button>
            <form method="POST" action="{{ action('GameplansController@store') }}" id="gameplanForm">
                <input type="hidden" name="hidden-bar-input" id="hidden-bar-input">
                {{ csrf_field() }}
                <div class="form-group">
                    Title<input type="text" class="form-control" name="title" id="title" placeholder="Title">
                    @include('forms.error', ['field' => 'title'])
                </div>
                <div class="form-group">
                    Description<textarea rows="3" class="form-control" name="description" id="description"></textarea>
                    @include('forms.error', ['field' => 'description'])
                </div>
                <div class="form-group">
                    Date<input type="date" class="form-control" name="date" id="date">
                    @include('forms.error', ['field' => 'date'])
                </div>
                <div class="form-group">
                    Time<input type="time" class="form-control" name="time" id="time" placeholder="10:00">
                    @include('forms.error', ['field' => 'time'])
                </div>
                Add Hop-Stops
                <div class="form-group">
                    <div id="moreStopsDiv">
                        <select class="form-control barSelect">
                            <option value="">Pick a Hop-Stop</option>
                            @foreach($bars as $key => $bar)
                                <option value="{{ $key }}">{{ $bar }}</option>
                            @endforeach
                        </select>
                        @include('forms.error', ['field' => 'bar'])
                    </div>
                </div>
                <button type="submit" class ="btn btn-primary pull-right">Create</button>
            </form>
        </div>
    </div>
@stop