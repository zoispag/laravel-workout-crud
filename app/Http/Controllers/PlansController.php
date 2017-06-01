<?php

namespace App\Http\Controllers;

use Request;
use App\Plan;
use App\Mail\PlanUpdated;
use App\Mail\PlanDeleted;

class PlansController extends Controller
{
    public function index()
    {
        $plans = Plan::all();

        if (Request::ajax()) {
            return Plan::all();
        } else {
            return view('plans.index', compact('plans'));
        }
        /*try{
            $statusCode = 200;
            $response = [
                'plans'  => []
            ];

            $plans = Plan::all();

            foreach($plans as $$plans){

                $response['plans'][] = [
                    'id' => $plan->id,
                    'name' => $plan->name,
                ];
            }
        }catch (Exception $e){
            $statusCode = 400;
        }finally{
            return Response::json($response, $statusCode);
        }*/
    }

    public function show($id)
    {
        $plan = Plan::find($id);
        return view('plans.show', compact('plan'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function edit($id)
    {
        $plan = Plan::find($id);
        return view('plans.edit', compact('plan'));
    }

    public function update($id)
    {
        $_scrap=Request::all();
        $plan=Plan::find($id);
        $plan->update($_scrap);
        foreach($plan->trainees as $trainee)
            \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = ''));
        return view('plans.show', compact('plan'));
    }

    public function store()
    {
        $plan = new Plan;
        $plan->name = request('name');

        $plan->save();

        return redirect('/plans');
    }

    public function destroy($id)
    {
        $plan = Plan::find($id);
        foreach($plan->trainees as $trainee) {
            $trainee->unassignPlan(false);
            \Mail::to($trainee->email)->send(new PlanDeleted);
        }
        foreach ($plan->days as $day) {
            foreach ($day->exercises as $exercise) {
                $exercise->removeNow();
            }
            $day->removeNow();
        }
        $plan->delete();
        return redirect()->route('plans.index');
    }
}
