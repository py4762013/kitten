@if (count($errors->all()) > 0)
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert"">&times;</button>
    <h4>{{{Lang::get('Error')}}}</h4>
    {{{Lang::get('Please check the form below for errors')}}}
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>{{{Lang::get('Success')}}}</h4>
    @if(is_array($message))
        @foreach($message as $m)
            {{ $m }}
        @endforeach
    @else
        {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block"
     <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>{{{Lang::get('Error')}}}</h4>
    @if(is_array($message))
        @foreach($message as $m)
            {{ $m }}
        @endforeach
    @else
        {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>{{{Lang::get('Warning')}}}</h4>
    @if(is_array($message))
        @foreach($message as $m)
            {{ $m }}
        @endforeach
    @else
        {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>{{{Lang::get('Info')}}}</h4>
    @if(is_array($message))
        @foreach($message as $m)
            {{ $m }}
        @endforeach
    @else
        {{ $message }}
    @endif
</div>
@endif