<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlanUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $main;
    public $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($main, $reason)
    {
        $this->main = $main;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.planUpdated')->with([
            'main' => $this->main,
            'reason' => $this->reason
        ]);
    }
}
