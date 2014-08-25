@extends('default')

@section('title')
{{{ Lang::get('Cats.Show') }}}
@parent
@stop

@section('content')
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

    <div class="dropdown pull-right">
        @if (Auth::check() && ($cat->user_id == Auth::user()->id))
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown">
            {{{ Lang::get('Action') }}}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('cats/edit/'. $cat->id) }}">{{{ Lang::get('Edit') }}}</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('cats/delete/'. $cat->id) }}">{{{ Lang::get('Delete') }}}</a></li>
        </ul>
        @else
        <a href="{{ URL::to('cats/show/'. $cat->id) }}" class="btn btn-default">{{{ Lang::get('View') }}}</a>
        @endif
    </div>

</div>

<hr>
@stop