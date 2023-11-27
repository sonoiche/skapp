<?php

namespace App\Jobs;

use App\Mail\SendNotificationEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNotificationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $proposal;
    
    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user_id    = auth()->user()->id;
        $proposal   = $this->proposal;
        $user       = User::find($proposal->user_id);
        $committee  = User::find($user_id);
        Mail::to($user->email)->send(new SendNotificationEmail($user, $proposal, $committee));
    }
}
