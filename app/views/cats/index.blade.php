@extends('default')

@section('title')
    {{{ Lang::get('Cats.Show') }}}
@parent
@stop

@section('content')
@foreach($cats as $cat)
<div class="col-lg-12 row">
    <h1 class="centered">{{{ $cat->name }}}</h1>
    <br>
    <div class="col-lg-6">
        <img class="img-responsive" src="{{ asset($cat->img) }}" alt="{{{ $cat->name }}}">
    </div>

    <div class="col-lg-6">
        <div class="panel panel-success">
            <div class="panel-heading">{{{ Lang::get('Cat\'s Name') }}}</div>
            <div class="panel-body">{{{ $cat->name }}}</div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">{{{ Lang::get('Cat\'s Birthday') }}}</div>
            <div class="panel-body">{{{ $cat->birthday }}}</div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">{{{ Lang::get('Cat Owners ') }}}</div>
            <div class="panel-body">{{{ $cat->host->username }}}</div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">{{{ Lang::get('Cat\'s Breed') }}}</div>
            <div class="panel-body">{{{ $cat->breed->name }}}</div>
        </div>
    </div>

</div>
<hr>
@endforeach
@stop