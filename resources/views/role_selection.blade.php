@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Select role</div>
                @if (!Auth::guest())
                    <div>
                        <form method="post" action="home">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden"  name="role" value="Student">
                            <button type="submit" class="btn btn-info">@lang('messages.student')</button>
                        </form>
                        <form method="post" action="home">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden"  name="role" value="Profesor">
                            <button type="submit" class="btn btn-info">@lang('messages.profesor')</button>
                        </form>
                        <form method="post" action="home">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden"  name="role" value="Admin">
                            <button type="submit" class="btn btn-info">Admin</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
