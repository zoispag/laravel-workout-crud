<?php

namespace App\Http\Controllers;

use Request;
use App\Day;
use App\Mail\PlanUpdated;

class DaysController extends Controller
{
    public function index()
    {
        $days = Day::all();
        return view('days.index', compact('days'));
    }

    public function show($id)
    {
        $day = Day::find($id);
        return view('days.show', compact('day'));
    }

    public function create($plan_id)
    {
        $plan = \App\Plan::find($plan_id);
        return view('days.create', compact('plan'));
    }

    public function edit($id, $plan_id)
    {
        $plan = \App\Plan::find($plan_id);
        $day = Day::find($id);
        return view('days.edit', compact('day', 'plan'));
    }

    public function update($id)
    {
        $_scrap=Request::all();
        $day=Day::find($id);
        $day->update($_scrap);
        foreach($day->plan->trainees as $trainee)
            \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'A workout day in your plan has been updated.'));
        return view('days.show', compact('day'));
    }

    public function store()
    {
        $day = new Day;
        $day->name = request('name');
        $day->plan_id = request('plan_id');

        foreach($day->plan->trainees as $trainee)
            \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'A workout day has been added to your plan.'));

        $day->save();

        return redirect('/plans/'.$day->plan_id);
    }

    public function destroy($id)
    {
        $day = Day::find($id);
        $plan_id = $day->plan_id;
        foreach($day->plan->trainees as $trainee)
            \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'A workout day in your plan has been deleted.'));
        foreach ($day->exercises as $exercise)
            $exercise->removeNow();
        $day->delete();
        return redirect('/plans/'.$plan_id);
    }
}
