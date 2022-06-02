@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if (!Auth::guest())
                        @foreach($dataUsers as $user)
                            @if(Auth::user()->email == $user->email)
                                <div class="panel-body">
                                    <p>@lang(('messages.details'))</p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        @if(!Auth::guest())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        @if(Auth::user()->role == 'Admin')
                            <div class="panel-body">
                                @foreach($dataUsers as $user)
                                    @if($user->role != 'Admin')
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4>{{ $user->name }}</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h4>{{ $user->role }}</h4>
                                            </div>
                                            <div class="col-md-6">
                                                <form method="post" action="editUser">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <div class="col-md-3">
                                                        <select required class="selectpicker" name="role">
                                                            <option value="Profesor">@lang('messages.profesor')</option>
                                                            <option value="Student">@lang('messages.student')</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="submit" class="btn btn-info">@lang('messages.button')</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @elseif(Auth::user()->role == 'Profesor')
                            <div class="panel-heading">
                                <form action="{{ url('/addWork') }}">
                                    <input type="submit" value="@lang('messages.add_task')"/>
                                </form>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('messages.name')</th>
                                        <th scope="col">@lang('messages.name_english')</th>
                                        <th scope="col">@lang('messages.description')</th>
                                        <th scope="col">@lang('messages.study_type')</th>
                                        <th scope="col">@lang('messages.student')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dataTasks as $task)
                                        @if($task->profesor==Auth::user()->name)
                                            <tr>
                                                <td scope="row">{{ $task->name }}</td>
                                                <td scope="row">{{ $task->name_en }}</td>
                                                <td scope="row">{{ $task->task_goal }}</td>
                                                <td scope="row">{{ $task->study_type }}</td>
                                                <td scope="row">
                                                    @if($task->choosen_student == null)
                                                        <form method="get" action="accept">
                                                            <input type="hidden" name="taskId" value="{{ $task->id }}">
                                                            <button type="submit" class="btn btn-info">@lang('messages.chooseStudent')</button>
                                                        </form>
                                                    @else
                                                        <label>Odabrani student:</label>
                                                        <p>{{$task->choosen_student}}</p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('messages.name')</th>
                                        <th scope="col">@lang('messages.name_english')</th>
                                        <th scope="col">@lang('messages.description')</th>
                                        <th scope="col">@lang('messages.study_type')</th>
                                        <th scope="col">@lang('messages.profesor')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dataTasks as $task)
                                        <tr>
                                            <td scope="row">{{ $task->name }}</td>
                                            <td scope="row">{{ $task->name_en }}</td>
                                            <td scope="row">{{ $task->task_goal }}</td>
                                            <td scope="row">{{ $task->study_type }}</td>
                                            <td scope="row">{{ $task->profesor }}</td>
                                            <td scope="row">
                                                <form method="post" action="registerWork">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="user" value="{{Auth::user()->name}}">
                                                    <input type="hidden" name="taskId" value="{{$task->id}}">
                                                    <button type="submit" class="btn btn-info" >@lang('messages.apply')</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
