<?php

namespace App\Http\Controllers;

use Request;
use App\Trainee;
use App\Plan;

class TraineesAPIController extends Controller
{
    public function index()
    {
        try {
            $response = [];
            $statusCode = 200;
            $trainees = Trainee::all();
            $response = [
                'trainees' => $trainees->toArray(),
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
            $trainee = Trainee::find($id);
            $response = [
                'trainee' => $trainee->toArray(),
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
            $trainee=Trainee::find($id);
            $trainee->update($_scrap);
            $response = [
                'message' => 'Trainee updated successfully.',
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
            $trainee = new Trainee();
            $trainee->name = request('name');
            $trainee->surname = request('surname');
            $trainee->email = request('email');
            $trainee->birth_year = request('birth_year');
            $trainee->save();
            $response = [
                'message' => 'A new trainee has been registered successfully.',
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
            Trainee::find($id)->delete();
            $response = [
                'message' => 'Trainee deleted successfully.',
            ];
        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return response($response,$statusCode);
        }
    }
}
