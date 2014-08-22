@extends('default')

@section('title')
    {{{ Lang::get('View Artile') }}}
@parent
@stop

@section('content')
<div class="row centered">
    <h1>{{ $article->title }}</h1>
    <br>
    <br>
    <div class="col-lg-12">
        <img class="img-responsive" src="{{ asset('design/img/'.$article->img) }}">
    </div>
    <br>
    <div class="col-lg-12">
        {{{ $article->description }}}
    </div>
    <br>
</div>
@stop