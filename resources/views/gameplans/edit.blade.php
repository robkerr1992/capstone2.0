@extends('layouts.master')
@section('content')
    {{--{{dd($bars)}}--}}
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Update your gameplan</h4>
            <form method="POST" action="{{ action('GameplansController@update', $gameplan->id) }}" id="gameplanForm">
                <input type="hidden" name="hidden-bar-input" id="hidden-bar-input">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    Title<input type="text" class="form-control" name="title" id="title" placeholder="Title">
                    @include('forms.error', ['field' => 'title'])
                </div>
                <div class="form-group">
                    Description<textarea rows="3" class="form-control" name="description" id="description"></textarea>
                    @include('forms.error', ['field' => 'description'])
                </div>
                <div class="form-group">
                    Date<input type="date" class="form-control" name="date" id="date" placeholder="YYYY-MM-DD" value="{{ $gameplan->date->format('Y-m-d') }}">
                    @include('forms.error', ['field' => 'date'])
                </div>
                <div class="form-group">
                    Time<input type="time" class="form-control" name="time" id="time" placeholder="00:00" value="{{ $gameplan->time->format('H:i') }}">
                    @include('forms.error', ['field' => 'time'])
                </div>
                <div class="form-group">
                    Bar1<select class="form-control barSelect" name="bar1" id="bar1">
                        @foreach($bars as $key => $bar)
                            <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 1'])
                </div>
                <div class="form-group">
                    Bar2<select class="form-control barSelect" name="bar2" id="bar2">
                        <option value="">Add Bar</option>
                        @foreach($bars as $key => $bar)
                            <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 2'])
                </div>
                <div class="form-group">
                    Bar3<select class="form-control barSelect" name="bar3" id="bar3">
                        <option value="">Add Bar</option>
                        @foreach($bars as $key => $bar)
                            <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 3'])
                </div>
                <div class="form-group">
                    Bar4<select class="form-control barSelect" name="bar4" id="bar4">
                        <option value="">Add Bar</option>
                        @foreach($bars as $key => $bar)
                            <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 4'])
                </div>
                <div class="form-group">
                    Bar5<select class="form-control barSelect" name="bar5" id="bar5">
                        <option value="">Add Bar</option>
                        @foreach($bars as $key => $bar)
                            <option value="{{ $key }}">{{ $bar }}</option>
                        @endforeach
                    </select>
                    @include('forms.error', ['field' => 'bar 5'])
                </div>
                <button type="submit" class ="btn btn-primary pull-right">Update</button>
            </form>
        </div>
    </div>
@stop