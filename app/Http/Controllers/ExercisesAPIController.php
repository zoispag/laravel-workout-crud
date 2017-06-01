<?php

namespace App\Http\Controllers;

use Request;
use App\Day;
use App\Exercise;
use App\Mail\PlanUpdated;

class ExercisesAPIController extends Controller
{
    public function index()
    {
        try {
            $response = [];
            $statusCode = 200;
            $exercises = Exercise::all();
            $response = [
                'exercises' => $exercises->toArray(),
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
            $exercise = Exercise::find($id);
            $response = [
                'exercise' => $exercise->toArray(),
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
            $exercise=Exercise::find($id);
            $exercise->update($_scrap);
            foreach($exercise->day->plan->trainees as $trainee)
                \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'An exercise in a day of your assigned plan has been edited.'));
            $response = [
                'message' => 'A new exercise has been created successfully.',
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
            $exercise = new Exercise;
            $exercise->name = request('name');
            $exercise->sets = request('sets');
            $exercise->reps = request('reps');
            $exercise->rest = request('rest');
            $exercise->day_id = request('day_id');
            foreach($exercise->day->plan->trainees as $trainee)
                \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'An new exercise has been added in a day of your assigned plan.'));
            $exercise->save();
            $response = [
                'message' => 'A new exercise has been created successfully.',
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
            $exercise = Exercise::find($id);
            foreach($exercise->day->plan->trainees as $trainee)
                \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'An exercise in a day of your assigned plan has been deleted.'));
            $exercise->delete();
            $response = [
                'message' => 'Exercise deleted successfully.',
            ];
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return response($response,$statusCode);
        }
    }
}
