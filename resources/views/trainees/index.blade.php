@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Trainees list</h2>
            <hr />
            <a class="btn btn-primary" href="/trainees/create"><i class="fa fa-plus"></i> Register new trainee</a >
        </div>
    </div>
    <br />

    @if($trainees->count())

        <div class="row">
            @foreach ($trainees as $trainee)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="jumbotron">
                        <h3><a href="/trainees/{{ $trainee->id }}">{{ $trainee->name.' '.$trainee->surname }}</a></h3>
                        <p>{{$trainee->email}}</p>
                        <p>{{date("Y") - $trainee->birth_year}} years old</p>
                        <br/>
                        @if($trainee->plan)
                            <p><a href="/plans/{{$trainee->plan->id}}"><strong>{{ $trainee->plan->name }}</strong></a><br /><a class="btn btn-danger btn-sm" href="/trainees/unassign/{{ $trainee->id }}"><i class="fa fa-minus-circle" aria-hidden="true"></i> Unassign</a ></p>
                        @else
                            <p><strong class="text-danger">No plan assigned</strong><br /><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#plansModal" data-trainee="{{ $trainee->id }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Assign</button ></p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @include('trainees.partial.modal')

    @else
        <h5 class="text-default">
            <em>There are no trainees yet. Feel free to register a new one.</em>
        </h5>
    @endif

@endsection

@section('scripts')

    <script>
        $('document').ready(function() {
            $('#plansModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var trainee_id = button.data('trainee'); // Extract info from data-* attributes
                var modal = $(this);
                modal.find('.modal-title').text('Add plan');
                $('#planSelect').attr('href', '/trainees/assign/' + trainee_id + '/#');
                $('#planlist').change(function () {
                    $('#planSelect').attr('href', '/trainees/assign/' + trainee_id + '/' + $('#planlist').val());
                });
            });
        });
    </script>

@endsection