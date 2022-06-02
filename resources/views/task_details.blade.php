@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="row panel-body">
                    <b>Detalji:</b>
                </div>
                @foreach($tasksData as $task)
                    <form method="post" action="accept/confirm">
                        <input type="hidden" name="task_id" value="{{$task->id}}">
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>@lang('messages.name')</th>
                                    <th>@lang('messages.description')</th>
                                    <th>@lang('messages.study_type')</th>
                                    <th>@lang('messages.student')</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>{{$task->name}}</td>
                                    <td>{{$task->task_goal}}</td>
                                    <td>{{$task->study_type}}</td>
                                    <td>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <select name="student">
                                            @if(empty($students))
                                                <optgroup label=@lang('messages.noStudents')></optgroup>
                                            @else
                                                <optgroup label=@lang('messages.chooseStudent')></optgroup>
                                                @foreach($students as $student)
                                                    <option>{{$student}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-info">@lang('messages.confirmStudent')</button>
                     </form>
                 @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
