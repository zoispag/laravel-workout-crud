@extends('layouts.master')

@section('content')

    <h1>Create a new exercise</h1>
    <hr />
    <form method="POST" action="/exercises">

        {{ csrf_field() }}

        <input type="hidden" name="day_id" id="day_id" value="{{ $day->id }}">

        <div class="form-group">
            <label for="name">Exercise Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="sets">Sets</label>
            <input type="text" class="form-control" id="sets" name="sets">
        </div>
        <div class="form-group">
            <label for="reps">Reps</label>
            <input type="text" class="form-control" id="reps" name="reps">
        </div>
        <div class="form-group">
            <label for="rest">Rest</label>
            <input type="text" class="form-control" id="rest" name="rest">
        </div>
        <button type="submit" class="btn btn-primary create-exercise">Save Exercise</button>
    </form>

@endsection