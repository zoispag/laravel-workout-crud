@extends('layouts.master')

@section('content')

    <h1>Edit workout day</h1>
    <hr />
    {!! Form::model($trainee, ['method' => 'patch','route'=>['trainees.update',$trainee->id]]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('surname', 'Surname:') !!}
        {!! Form::text('surname',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('birth_year', 'Birth Year:') !!}
        {!! Form::text('birth_year',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::button('Update Trainee', [
        'class' => 'btn btn-primary update-trainee',
        'value' => $trainee->id
    ]) !!}

    {!! Form::close() !!}

@endsection

