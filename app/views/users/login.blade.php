@extends('default')

{{-- website title --}}
@section('title')
{{{ Lang::get('user.login') }}}
@parent
@stop

@section('content')
{{ Confide::makeLoginForm()->render() }}
@stop