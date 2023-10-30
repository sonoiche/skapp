<?php

namespace App\Console\Commands;

use App\Jobs\SendReminderEmailJob;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:event-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send email notification and reminder to every user about upcoming events.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $future = Carbon::now()->addDays(3)->format('Y-m-d');
        $today  = Carbon::now()->format('Y-m-d');
        $events = Event::where('date_from', '>', $today)->get();
        foreach ($events as $item) {
            if($item->date_from == $future) {
                SendReminderEmailJob::dispatch($item)->delay(Carbon::now()->addSeconds(5));
            }
        }
    }
}
