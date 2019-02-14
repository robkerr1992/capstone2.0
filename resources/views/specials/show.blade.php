@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <h1><a href="{{ action('BarsController@show', $special->bar->id) }}"> {{ $special->bar->name }}</a></h1>
            <h2>{{ $special->title }}</h2>
            {{ $special->content }}
            @if((Auth::user()) && (Auth::user()->id == $special->created_by))
                <div>
                    <a class="btn btn-success" href="{{action('SpecialsController@edit', $special->id) }}">Edit Special</a>
                    <form method="POST" action="{{action('SpecialsController@destroy', $special->id) }}">
                        <input type="submit" class="btn btn-danger" value="Delete Special">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </div>
            @endif
        </div>
        <div class="row">
        <small><a class="btn btn-info" href="{{ action('SpecialsController@index') }}">Go to specials</a></small>
        </div>
    </div>
@stop