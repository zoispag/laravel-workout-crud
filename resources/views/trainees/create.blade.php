@extends('layouts.master')

@section('content')

    <h1>Register a new trainee</h1>
    <hr />
    <form method="POST" action="/trainees">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="lastname">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname">
        </div>
        <div class="form-group">
            <label for="email">e-mail</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="birth_year">Year of Birth</label>
            <input type="birth_year" class="form-control" id="birth_year" name="birth_year">
        </div>
        <button type="submit" class="btn btn-primary create-trainee">Save Trainee</button>
    </form>

@endsection