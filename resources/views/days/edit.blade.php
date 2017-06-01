@extends('layouts.master')

@section('content')

    <h1>Edit workout day</h1>
    <hr />
    {!! Form::model($day, ['method' => 'patch','route'=>['days.update',$day->id]]) !!}

    <input type="hidden" name="plan_id" id="plan_id" value="{{ $plan->id }}">

    <div class="form-group">
        {!! Form::label('name', 'Day Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::button('Update Day', [
        'class' => 'btn btn-primary update-day',
        'value' => $day->id
    ]) !!}

    {!! Form::close() !!}

@endsection

