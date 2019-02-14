@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Update Special</h4>
            <form method="POST" action="{{ action('SpecialsController@update', $special->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="title" id="title" value="{{ $special->title }}">
                    @include('forms.error', ['field' => 'title'])
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" id="content">{{ $special->content }}</textarea>
                    @include('forms.error', ['field' => 'content'])
                </div>
                <button type="submit" class ="btn btn-primary pull-right">Update Special</button>
            </form>
        </div>
    </div>
@stop