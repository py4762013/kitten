@extends('default')

{{-- Article Index Page --}}
@section('title')
    {{{ Lang::get('Artile.Index') }}}
@parent
@stop

{{-- Article Content --}}
@section('content')
@foreach($articles as $article)
<div class="col-lg-12">
    <h3>{{{ $article->title }}}</h3>
    <a href="{{ URL::to('articles/show/'.$article->id) }}"><img class="img-responsive" src="{{ asset('design/img/'.$article->img) }}"></a>
    <br/>
    {{{ $article->description }}}
    <div class="row">
        <div class="col-lg-8">
            <span class="label label-default">{{{ Lang::get('Author:') }}}<a href="#">{{$article->author->username}}</a></span>
            |
            <span class="label label-default">{{{ Lang::get('Date:') }}}<a href="#">{{ $article->created_at }}</a></span>
            |
            <span class="label label-default"><a href="#">{{{ Lang::get('Comments') }}}</a></span>
        </div>
        <div class="col-lg-4">
            @if (Auth::check() && (Auth::user()->id == $article->user_id))
                <!--<a href="{{ URL::to('articles/edit/'.$article->id) }}" class="btn btn-primary pull-right active">{{{ Lang::get('Edit') }}}</a>-->
                <div class="dropdown pull-right">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownmenu" data-toggle="dropdown">
                        {{{ Lang::get('Action') }}}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('articles/edit/'.$article->id) }}">{{{ Lang::get('Edit') }}}</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ URL::to('articles/delete/'.$article->id) }}">{{{ Lang::get('Delete') }}}</a></li>
                    </ul>
                </div>
            @else
                <a href="{{ URL::to('articles/show/'.$article->id) }}" class="btn btn-primary pull-right active">{{{ Lang::get('View') }}}</a>
            @endif
        </div>
    </div>
    <hr>
</div>
@endforeach
{{ $articles->links() }}
@stop