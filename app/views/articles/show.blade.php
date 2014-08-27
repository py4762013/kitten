@extends('default')

@section('title')
    {{{ Lang::get('View Artile') }}}
@parent
@stop

@section('content')
<div class="row centered">
    <h3>{{ $article->title }}</h3>
    <br>
    <div class="col-lg-12">
        <img class="img-responsive" src="{{ asset('design/img/'.$article->img) }}">
    </div>
    <br>
    <div class="col-lg-12">
        {{{ $article->description }}}
    </div>
    <span class="label label-default pull-right">{{ Lang::get('Author') }}:{{ $article->author->username }} | {{ Lang::get('Date') }}:{{ $article->created_at }}</span>
</div>
<h4>{{ $comments->count() }} {{{ Lang::get('Comments') }}}</h4>

@if($comments->count() > 0)

@foreach($comments as $comment)
<div clas="form-horizontal">
    <div class="form-group">
        <label class="label label-default">{{ $article->author->username }}</label>: <div class="lead" style="display: inline">{{{ $comment->content }}}</div>
        <div class="pull-right">
            <label class="label label-default">{{{ Lang::get('Date') }}}:</label> <a href="#">{{ $article->created_at }}</a>
        </div>
    </div>
</div>
<hr>
@endforeach

@endif

@if(!Auth::check())
    {{{ Lang::get('Please Logged to Add Comment,Click') }}}<a href="{{ URL::to('users/login') }}"> {{{ Lang::get('Here') }}} </a>{{{ Lang::get('do Login') }}}
@else
{{ Form::open(array('url'=>'comments/article')) }}
{{ Form::label('Add Comments', '', array('class'=>'control-label')) }}
{{ Form::hidden('id',$article->id) }}
{{ Form::textarea('content', '', array('class'=>'form-control', 'placeholder'=>'Enter Your Comment')) }}
{{ Form::submit('Submit', array('class'=>'btn btn-primary pull-right')) }}
{{ Form::close() }}
<br/>
@endif
<hr>
@stop