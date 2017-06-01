@extends('layouts.master')

@section('content')

    <h2>Exercises list</h2>
    <hr />
    <div class="row">
        @foreach($exercises as $exercise)
            <div class="col-12 col-md-6 col-lg-4">
                <h3><a href="/exercises/{{ $exercise->id }}">{{ $exercise->name  }}</a></h3>
                <p><strong>Sets/Reps:</strong> {{ $exercise->sets }}x{{ $exercise->reps }}
                <br />Rest Time: {{ $exercise->rest }}"</br>
                @if($exercise->day)
                    <p class="small">Belongs to <a href="/days/{{ $exercise->day->id }}">{{ $exercise->day->name }}</a> <br />Plan: <a href="/plans/{{ $exercise->day->plan->id }}">{{ $exercise->day->plan->name }}</a></p>
                @else
                    <p class="small">Doesn't belong to any day</p>
                @endif
            </div>
        @endforeach
    </div>

@endsection