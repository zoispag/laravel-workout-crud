<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\PlanUpdated;

class Trainee extends Model
{
    public $fillable = ['name','surname','email','birth_year','plan_id'];

    // A trainee has a plan
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    /**
     * A function to assign a plan to a trainee
     *
     * * assignPlan() will receive the id of a plan,
     * * and assign it as plan_id in a trainee.
     *
     * @param integer $id
     * @return void
     */
    public function assignPlan($id){
        $this->plan_id = $id;
        \Mail::to($this->email)->send(new PlanUpdated($main = 'You have been assigned to a plan.', $reason = ''));
        $this->save();
    }

    /**
     * A function to unassign a plan from a trainee
     *
     * * unassignPlan() will send email notification to trainee.
     * * Call with boolean false argument to skip email notification.
     *
     * @param bool $sendMail
     * @return void
     */
    public function unassignPlan($sendMail = true){
        $this->plan_id = null;
        if($sendMail) {
            \Mail::to($this->email)->send(new PlanUpdated($main = 'You have been unassigned from a plan.', $reason = ''));
        }
        $this->save();
    }
}
