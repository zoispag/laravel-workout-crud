@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Plans list</h2>
            <hr />
            <a class="btn btn-primary" href="/plans/create"><i class="fa fa-plus"></i> Create new plan</a >
        </div>
    </div>
    <br />

    @if($plans->count())
        <div class="row">
           @foreach($plans as $plan)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="jumbotron">
                    <h4><a href="/plans/{{$plan->id}}">{{ $plan->name }}</a></h4>
                    @if($plan->days->count())
                        <?php $count = 0; ?>
                            @foreach ($plan->days as $day)
                                <?php $count++; ?>
                                <div><?=$count?>) <a href="/days/{{$day->id}}"><span class="badge badge-primary">{{ $day->name }}</span></a></div>
                            @endforeach
                    @else
                        <h4 class="small text-danger">This plan has no workout days yet.</h4>
                    @endif
                    @if($plan->trainees->count())
                        Assigned to:<br/>
                        @foreach($plan->trainees as $trainee)
                            <a href="/trainees/{{$trainee->id}}"><span class="badge badge-default">{{$trainee->name.' '.$trainee->surname}}</span></a>
                            <br/>
                        @endforeach
                    @else
                        Unassigned plan.
                    @endif
                </div>
            </div>
           @endforeach
        </div>
    @else
        <h5 class="text-default">
            <em>There are no plans yet. Feel free to create a new one.</em>
        </h5>
    @endif
@endsection