@extends('layouts.master')

@section('content')

    <h2>Days list</h2>
    <hr />
    <div class="row">
        @foreach($days as $day)
            <div class="col-12 col-md-6 col-lg-4">
                <h3><a href="/days/{{ $day->id }}">{{ $day->name  }}</a></h3>
                @if($day->plan)
                    <p class="small">Belongs to <a href="/plans/{{ $day->plan->id }}">{{ $day->plan->name }}</a></p>
                @else
                    <p class="small">Doesn't belong to any plan</p>
                @endif
                @if($day->exercises->count())
                    @foreach ($day->exercises as $exercise)
                        <span>{{$exercise->name}}</span>
                    @endforeach
                @else
                    <p>No execrices</p>
                @endif
            </div>
        @endforeach
    </div>

@endsection