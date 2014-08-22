@extends('default')

@section('title')
    {{{ Lang::get('Article.Craete') }}}
@parent
@stop

@section('content')
<div class="col-lg-12">
    <h3>{{{ Lang::get('Add a article') }}}</h3>
    <br>
    {{ Form::open(array('role'=>'form','url'=>'articles/store','files'=>true)) }}
    <div class="form-group">
        {{ Form::label('title', 'Article Title') }}
        {{ Form::text('title', '',array('class'=>'form-control','placeholder'=>'Input article title')) }}
    </div>
    <div class="form-group">
        {{ Form::label('photo', 'Article Photo') }}
        {{ Form::file('img') }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Article Content') }}
        {{ Form::textarea('description', '', array('class'=>'form-control', 'placeholder'=>'Input article content')) }}
    </div>
    <div class="form-group">
        {{ Form::submit('submit', array('class'=>'btn btn-large btn-success')) }}
    </div>
    {{ Form::close() }}
</div>
@stop