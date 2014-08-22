@extends('default')

{{-- Web Site Title --}}
@section('title')
{{{ Lang::get('User.Register') }}}
@parent
@stop

{{-- Content --}}
@section('content')
    {{ Confide::makeSignupForm()->render() }}
@stop