@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Plan details</h2>
            <hr />
        </div>
    </div>
    <div class="jumbotron">
        <h2>
            {{ $plan->name }}
        </h2>
        @if($plan->trainees->count())
            <p>
                This plan is currenlty assigned to:
                @foreach($plan->trainees as $trainee)
                    <a href="/trainees/{{$trainee->id}}"><span class="badge badge-default">{{$trainee->name.' '.$trainee->surname}}</span></a>
                @endforeach
            </p>
        @else
            <p>This plan is currently not assigned to any trainee.</p>
        @endif
        <div class="row col-md-6">
        <a class="btn btn-warning btn-sm" href="/plans/{{$plan->id}}/edit"><i class="fa fa-pencil-square-o"></i> Edit</a >
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['plans.destroy', $plan->id]
            ]) !!}
            {!! Form::button('<i class="fa fa-trash-o"></i> Delete', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-sm delete-plan',
                'style' => 'margin-left: 2px',
                'value' => $plan->id
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary" href="/days/create/{{$plan->id}}"><i class="fa fa-plus"></i> Add new Day</a >
        </div>
    </div>
    <br />

    @if($plan->days->count())
        <div class="row">
            @foreach ($plan->days as $day)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="jumbotron">
                        <h3><a href="/days/{{$day->id}}">{{ $day->name }}</a></h3>
                        <br />
                        @if($day->exercises->count())
                            <table class="table table-bordered table-hover table-stripped">
                                <tr>
                                    <th>Exercise</th>
                                    <th>Sets</th>
                                    <th>Reps</th>
                                    <th>Rest</th>
                                </tr>
                                @foreach ($day->exercises as $exercise)
                                    <tr>
                                        <td>{{$exercise->name}}</td>
                                        <td>{{$exercise->sets}}</td>
                                        <td>{{$exercise->reps}}</td>
                                        <td>{{$exercise->rest}}"</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-danger"><em>The plan has no exercises</em></p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3 class="text-danger">This plan has no days yet.</h3>
    @endif
    <br />
    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-primary" href="/plans/"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Plans</a>
        </div>
    </div>

@endsection