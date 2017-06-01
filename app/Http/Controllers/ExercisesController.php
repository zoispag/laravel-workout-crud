<?php

namespace App\Http\Controllers;

use Request;
use App\Day;
use App\Exercise;
use App\Mail\PlanUpdated;

class ExercisesController extends Controller
{
    public function index()
    {
        $exercises = Exercise::all();
        return view('exercises.index', compact('exercises'));
    }

    public function show($id)
    {
        $exercise = Exercise::find($id);
        return view('exercises.show', compact('exercise'));
    }

    public function create($day_id)
    {
        $day = Day::find($day_id);
        return view('exercises.create', compact('day'));
    }

    public function edit($id, $day_id)
    {
        $day = Day::find($day_id);
        $exercise = Exercise::find($id);
        return view('exercises.edit', compact('exercise','day'));
    }

    public function update($id)
    {
        $_scrap=Request::all();
        $exercise=Exercise::find($id);
        $exercise->update($_scrap);
        foreach($exercise->day->plan->trainees as $trainee)
            \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'An exercise in a day of your assigned plan has been edited.'));
        return redirect('/days/'.$exercise->day_id);
    }

    public function store()
    {
        $exercise = new Exercise;
        $exercise->name = request('name');
        $exercise->sets = request('sets');
        $exercise->reps = request('reps');
        $exercise->rest = request('rest');
        $exercise->day_id = request('day_id');
        foreach($exercise->day->plan->trainees as $trainee)
            \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'An new exercise has been added in a day of your assigned plan.'));

        $exercise->save();

        return redirect('/days/'.$exercise->day_id);
    }

    public function destroy($id)
    {
        $exercise = Exercise::find($id);
        $day_id = $exercise->day_id;
        foreach($exercise->day->plan->trainees as $trainee)
            \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'An exercise in a day of your assigned plan has been deleted.'));
        $exercise->delete();
        return redirect('/days/'.$day_id);
    }
}
