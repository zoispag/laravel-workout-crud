<?php

namespace App\Http\Controllers;

use Request;
use App\Day;
use App\Mail\PlanUpdated;

class DaysAPIController extends Controller
{
    public function index()
    {
        try {
            $response = [];
            $statusCode = 200;
            $days = Day::all();
            $response = [
                'days' => $days->toArray(),
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
            $day = Day::find($id);
            $response = [
                'day' => $day->toArray(),
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
            $day=Day::find($id);
            $day->update($_scrap);
            foreach($day->plan->trainees as $trainee)
                \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'A workout day in your plan has been updated.'));
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
            $day = new Day;
            $day->name = request('name');
            $day->plan_id = request('plan_id');

            foreach($day->plan->trainees as $trainee)
                \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'A workout day has been added to your plan.'));

            $day->save();
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
            $day = Day::find($id);
            Day::find($id)->delete();
            foreach($day->plan->trainees as $trainee)
                \Mail::to($trainee->email)->send(new PlanUpdated($main = 'There has been a change to your assigned plan.', $reason = 'A workout day in your plan has been deleted.'));
            foreach ($day->exercises as $exercise)
                $exercise->removeNow();
            $response = [
                'message' => 'Day deleted successfully.',
            ];
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return response($response,$statusCode);
        }
    }
}
