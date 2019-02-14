@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Add a special</h4>
            <form method="POST" action="{{ action('SpecialsController@store') }}">
                {{ csrf_field() }}
                <input hidden name="bar_id" value="{{ $id }}">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                    @include('forms.error', ['field' => 'title'])
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" id="content" placeholder="Description"></textarea>
                    @include('forms.error', ['field' => 'content'])
                </div>
                <button type="submit" class ="btn btn-primary pull-right">Create Special</button>
            </form>
        </div>
    </div>
@stop
