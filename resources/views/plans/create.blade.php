@extends('layouts.master')

@section('content')

    <h1>Create a new plan</h1>
    <hr />
    <form method="POST" action="/plans">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Plan Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <button type="submit" class="btn btn-primary create-plan">Save Plan</button>

        @include('layouts.errors')

    </form>

@endsection