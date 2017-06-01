@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Trainee details</h2>
            <hr />
        </div>
    </div>
    <div class="jumbotron">
        <p>Name: {{ $trainee->name }}</p>
        <p>Surname: {{ $trainee->surname }}</p>
        <p>Email: {{ $trainee->email }}</p>
        <p>Year of Birth: {{$trainee->birth_year}}</p>
        @if($trainee->plan)
            <p>
                Assigned Plan: <a href="/plans/{{$trainee->plan->id}}">{{ $trainee->plan->name }}</a>
                <a class="btn btn-danger btn-sm" href="/trainees/unassign/{{ $trainee->id }}"><i class="fa fa-minus-circle" aria-hidden="true"></i> Unassign</a >
            </p>
        @else
            <p>
                There is no plan assigned to {{ $trainee->name }} {{ $trainee->surname }}
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#plansModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Assign</button >
            </p>
        @endif
        <p>
            <div class="row col-md-6">
                <a class="btn btn-warning" href="/trainees/{{$trainee->id}}/edit"><i class="fa fa-pencil-square-o"></i> Edit</a >
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['trainees.destroy', $trainee->id]
                ]) !!}
                {!! Form::button('<i class="fa fa-trash-o"></i> Delete', [
                    'type' => 'submit',
                    'class' => 'btn btn-danger delete-trainee',
                    'style' => 'margin-left: 2px',
                    'value' => $trainee->id
                ]) !!}
                {!! Form::close() !!}
            </div>
        </p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-primary" href="/trainees/"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Trainees</a>
        </div>
    </div>

    @include('trainees.partial.modal')

@endsection

@section('scripts')

    <script>
        $('document').ready(function() {
            $('#planlist').change(function() {
                $('#planSelect').attr('href','/trainees/assign/{{ $trainee->id }}/'+$('#planlist').val());
            });
        });
    </script>

@endsection