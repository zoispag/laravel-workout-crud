@extends('layouts.master')

@section('content')

    <div class="jumbotron">
        <h2>{{ $exercise->name  }}</h2><br />
        <p><strong>Sets/Reps:</strong> {{ $exercise->sets }}x{{ $exercise->reps }}
            <br />Rest Time: {{ $exercise->rest }}"</br>
        @if($exercise->day)
            <p class="small">Belongs to <a href="/days/{{ $exercise->day->id }}">{{ $exercise->day->name }}</a>. <br />Plan: <a href="/days/{{ $exercise->day->plan->id }}">{{ $exercise->day->plan->name }}</a></p>
        @else
            <p class="small">Doesn't belong to any day</p>
        @endif
        <a class="btn btn-warning btn-sm" href="/exercises/{{$exercise->id}}/edit"><i class="fa fa-pencil-square-o"></i></a >
        <button class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash-o"></i></button >
    </div>

@endsection