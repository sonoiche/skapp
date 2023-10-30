<?php

namespace App\Jobs;

use App\Mail\SendReminderEmail;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendReminderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $event      = $this->event;
        $user_ids   = Reminder::where('event_id', $event->id)->pluck('user_id');
        $users      = User::where('role', 'User')
            ->where('status', 'Active')
            ->whereNotIn('id', $user_ids)
            ->get();
        
        foreach ($users as $user) {
            Mail::to($user->email)->send(new SendReminderEmail($event, $user));
            $reminder = new Reminder();
            $reminder->event_id = $event->id;
            $reminder->user_id  = $user->id;
            $reminder->save();
        }
    }
}
