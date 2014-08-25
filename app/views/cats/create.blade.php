@extends('default')

@section('title')
    {{ Lang::get('Cat.Create') }}
@parent
@stop

@section('content')
<div class="col-lg-12">
    <h3>{{{ Lang::get('Add a cat') }}}</h3>
    <br>
    {{ Form::open(array('url'=>'cats/store', 'files'=>true)) }}
        <div class="form-group">
            {{ Form::label('name', 'Cat\'s name') }}
            {{ Form::text('name', '', array('class'=>'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('img', 'Cat\'s img') }}
            {{ Form::file('img') }}
        </div>
        <div class="form-group">
            {{ Form::label('birthday', 'Cat\'s birthday') }}
            {{ Form::text('birthday', '', array('class'=>'form-control')) }}
            {{-- Form::selectMonth('month') --}}
        </div>
        <div class="form-group">
            {{ Form::label('breed', 'Select Cat\'s Breed') }}
            {{ Form::select('breed_id', $breed_options, '', array('class'=>'form-control')) }}
        </div>
        {{ Form::submit('submit', array('class'=>'btn btn-default')) }}
    {{ Form::close() }}
</div>
@stop