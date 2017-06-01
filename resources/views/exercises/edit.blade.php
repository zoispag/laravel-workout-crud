@extends('layouts.master')

@section('content')

    <h1>Edit exercise</h1>
    <hr />
    {!! Form::model($exercise, ['method' => 'patch','route'=>['exercises.update',$exercise->id]]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    <input type="hidden" name="day_id" id="day_id" value="{{ $day->id }}">

    <div class="form-group">
        {!! Form::label('sets', 'Sets:') !!}
        {!! Form::number('sets',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('reps', 'Reps:') !!}
        {!! Form::number('reps',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('rest', 'Rest:') !!}
        {!! Form::number('rest',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::button('Update Exercise', ['
        class' => 'btn btn-primary update-exercise',
        'value' => $exercise->id
    ]) !!}

    {!! Form::close() !!}

@endsection

