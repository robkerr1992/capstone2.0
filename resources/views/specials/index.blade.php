@extends('layouts.master')

@section('content')
<div class="container">
<h3 class="h3-list-title">Specials</h3>
<hr>
    @foreach ($specials as $special)
    <div data-value="{{ $special->id }}" class="row list-card special">
        <div class="col-xs-6">
            <h4>{{ $special->title }}</h4>
            {{ substr($special->content, 0, 25) }}...
        </div>
        <div class="col-xs-6">
            <h4>@ <a href="/bars/{{ $special->bar->id }}">{{ $special->bar->name }}</a></h4>
        </div>
    </div>
    @endforeach
    {!! $specials->render() !!}
</div>
@stop