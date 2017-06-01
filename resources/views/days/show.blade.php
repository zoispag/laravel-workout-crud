@extends('layouts.master')

@section('content')

    <div class="jumbotron">
        <h2>
            {{ $day->name }}
        </h2>

        @if($day->plan)
            <p class="small">Belongs to <a href="/plans/{{ $day->plan->id }}">{{ $day->plan->name }}</a></p>
        @else
            <p class="small">Doesn't belong to any plan</p>
        @endif
        <div class="row col-md-6">
            <a class="btn btn-warning btn-sm" href="/days/{{$day->id}}/edit/{{$day->plan->id}}"><i class="fa fa-pencil-square-o"></i> Edit</a >
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['days.destroy', $day->id]
            ]) !!}
            {!! Form::button('<i class="fa fa-trash-o"></i> Delete', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-sm delete-day',
                'style' => 'margin-left: 2px',
                'value' => $day->id
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary" href="/exercises/create/{{$day->id}}"><i class="fa fa-plus"></i> Add new Exercise</a >
        </div>
    </div>
    <br />

    <div class="row">
        <div class="col-12">
            <div class="jumbotron">
                @if($day->exercises->count())
                    <table class="table table-bordered table-inverse">
                        <tr>
                            <th>Exercise</th>
                            <th>Sets</th>
                            <th>Reps</th>
                            <th>Rest</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($day->exercises as $exercise)
                            <tr id="exercise{{$exercise->id}}">
                                <td>{{$exercise->name}}</td>
                                <td>{{$exercise->sets}}</td>
                                <td>{{$exercise->reps}}</td>
                                <td>{{$exercise->rest}}"</td>
                                <td>
                                    <div class="row col-md-12">
                                        <a class="btn btn-warning btn-sm" href="/exercises/{{$exercise->id}}/edit/{{$day->id}}"><i class="fa fa-pencil-square-o"></i> Edit</a >
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['exercises.destroy', $exercise->id]
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o"></i> Delete', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm delete-exercise',
                                            'style' => 'margin-left: 2px',
                                            'value' => $exercise->id
                                        ]) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p class="text-danger"><em>This plan has no exercises yet. Feel free to add a new one.</em></p>
                @endif
            </div>
        </div>
    </div>

@endsection