@extends('layouts.master')

@section('content')

    <h1>Edit plan</h1>
    <hr />
    {!! Form::model($plan, ['method' => 'patch','route'=>['plans.update',$plan->id]]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Plan Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::button('Update Plan', [
        'class' => 'btn btn-primary update-plan',
        'value' => $plan->id
    ]) !!}

    {!! Form::close() !!}

@endsection

