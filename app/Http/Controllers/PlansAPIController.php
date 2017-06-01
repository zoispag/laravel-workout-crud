<?php

namespace App\Http\Controllers;

use Request;
use App\Plan;
use App\Mail\PlanUpdated;
use App\Mail\PlanDeleted;

class PlansAPIController extends Controller
{
    public function index()
    {
        try {
            $response = [];
            $statusCode = 200;
            $plans = Plan::all();
            $response = [
                'plans' => $plans->toArray(),
            ];
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return response($response,$statusCode);
        }
    }

    public function show($id)
    {
        try {
            $response = [];
            $statusCode = 200;
            $plan = Plan::find($id);
            $response = [
                'plan' => $plan->toArray(),
            ];
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return response($response,$statusCode);
        }
    }

    public function update($id)
    {
        try {
            $response = [];
            $statusCode = 200;
            $_scrap=Request::all();
            $plan=Plan::find($id);
            $plan->update($_scrap);
            foreach($plan->trainees as $trainee)
                \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = ''));
            $response = [
                'message' => 'Plan updated successfully.',
            ];
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return response($response,$statusCode);
        }
    }

    public function store()
    {
        try {
            $response = [];
            $statusCode = 200;
            $plan = new Plan();
            $plan->name = request('name');
            $plan->save();
            $response = [
                'message' => 'A new plan has been created successfully.',
            ];
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return response($response,$statusCode);
        }
    }

    public function destroy($id)
    {
        try {
            $response = [];
            $statusCode = 200;
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
            Plan::find($id)->delete();
            $response = [
                'message' => 'Plan deleted successfully.',
            ];
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return response($response,$statusCode);
        }
    }
}
