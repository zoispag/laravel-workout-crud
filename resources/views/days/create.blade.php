@extends('layouts.master')

@section('content')

    <h1>Create a new workout day</h1>
    <hr />
    <form method="POST" action="/days">

        {{ csrf_field() }}

        <input type="hidden" name="plan_id" id="plan_id" value="{{ $plan->id }}">

        <div class="form-group">
            <label for="name">Day Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <button type="submit" class="btn btn-primary create-day">Save Day</button>
    </form>

@endsection