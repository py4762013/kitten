<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" contet="This is a Kittten website">

        <title>
            @section('title')
                {{{ Lang::get('This is a Kitten Website') }}}
            @show
        </title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{asset('design/css/bootstrap.css')}}">

        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="{{asset('design/css/main.css')}}">

        <script src="{{asset('design/js/jquery-1.11.1.min.js')}}"></script>
        <script src="{{asset('design/js/smoothscroll.js')}}"></script>

        @yield('head')

    </head>
    <body data-spy="scroll" data-offset="0" data-target="navigation">

        <!-- Fixed navbar -->
        <div id="navgation" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{{ URL::to('home') }}}">{{{ Lang::get('Kitten') }}}</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a {{ (Request::is('home')) ? ' class="active"' : ''}} href="{{{ URL::to('home') }}}" class="smothscroll">{{{ Lang::get('Home') }}}</a></li>
                        <!--<li><a {{ (Request::is('user')) ? ' class="active"' : ''}} href="{{{ URL::to('user') }}}" class="smothscroll">{{{ Lang::get('User') }}}</a></li>-->
                        <li><a {{ (Request::is('cats')) ? ' class="active"' : ''}}href="{{{ URL::to('cats') }}}" class="smothscroll">{{{ Lang::get('Cat') }}}</a></li>
                        <li><a {{ (Request::is('article')) ? ' class="active"' : ''}}href="{{{ URL::to('articles') }}}" class="smothscroll">{{{ Lang::get('Article') }}}</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        @if (Auth::check())
                            <li><a {{ Request::is('users/logout') ? ' class="active"' : ''}} href="{{{ URL::to('users/logout') }}}">{{{ Lang::get('Logout') }}}</a></li>
                        @else
                            <li><a {{ Request::is('users/create') ? ' class="active"' : ''}} href="{{{ URL::to('users/create') }}}">{{{ Lang::get('Register') }}}</a></li>
                            <li><a {{ Request::is('users/login') ? ' class="active"' : ''}} href="{{{ URL::to('users/login') }}}">{{{ Lang::get('Login') }}}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Container -->
        <div class="container">
            <div class="row">
                <!-- Notifications -->
                @include('notifications')

                <!-- Content -->
                @yield('content')
            </div>
        </div>

        <!-- footer -->
        <div id="c">
            <div class="container">
                <p>Created By Kyo</p>
            </div>
        </div>

        <!-- Bootstrap core Javascript -->
        <script src="{{asset('design/js/bootstrap.js')}}"></script>
    </body>
<html>