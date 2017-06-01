<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{

    public $fillable = ['name','sets','reps','rest','day_id'];

    // Each exercise belongs to a day
    public function day(){
        return $this->belongsTo(Day::class);
    }

    public function removeNow()
    {
        $this->delete();
    }
}
