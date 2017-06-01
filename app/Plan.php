<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    public $fillable = ['name'];

    // A plan has many days
    public function days(){
        return $this->hasMany(Day::class);
    }

    // A plan has many trainees
    public function trainees(){
        return $this->hasMany(Trainee::class);
    }
}
