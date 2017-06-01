<?php

namespace App\Http\Controllers;

use Request;
use App\Trainee;
use App\Plan;

class TraineesController extends Controller
{
    public function index()
    {
        $trainees = Trainee::all();
        $plans = Plan::all();
        return view('trainees.index', compact('trainees', 'plans'));
    }

    public function show($id)
    {
        $trainee = Trainee::find($id);
        $plans = Plan::all();
        return view('trainees.show', compact('trainee', 'plans'));
    }

    public function create()
    {
        return view('trainees.create');
    }

    public function edit($id)
    {
        $trainee = Trainee::find($id);
        return view('trainees.edit', compact('trainee'));
    }

    public function update($id)
    {
        $_scrap=Request::all();
        $trainee=Trainee::find($id);
        $trainee->update($_scrap);
        return view('trainees.show', compact('trainee'));
    }

    public function store()
    {
        $trainee = new Trainee;
        $trainee->name = request('name');
        $trainee->surname = request('surname');
        $trainee->email = request('email');
        $trainee->birth_year = request('birth_year');

        $trainee->save();

        return redirect('/trainees');
    }

    public function destroy($id)
    {
        $trainee = Trainee::find($id);
        $trainee->delete();
        return redirect()->route('trainees.index');
    }

    public function assign($id, $plan_id)
    {
        $trainee = Trainee::find($id);
        $trainee->assignPlan($plan_id);
        $trainee->save();
        return redirect('/trainees/'.$trainee->id);
    }

    public function unassign($id)
    {
        $trainee = Trainee::find($id);
        $trainee->unassignPlan();
        $trainee->save();
        return back();
    }
}
