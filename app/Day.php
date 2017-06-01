<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{

    public $fillable = ['name','plan_id'];

    // Each day has a plan
    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    // A day has many exercises
    public function exercises(){
        return $this->hasMany(Exercise::class);
    }

    public function removeNow()
    {
        $this->delete();
    }
}
