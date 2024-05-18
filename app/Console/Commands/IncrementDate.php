<?php

namespace App\Console\Commands;

use App\Models\ScheduledClass;
use Illuminate\Console\Command;

class IncrementDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:increment-date';
    protected $signature = 'app:increment-date {--days=1}'; // default value of days is 1. If user doesn't specify the value, it will increment by 1 day

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment all the scheduled classes date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scheduledClasses = ScheduledClass::latest('date_time')->get();

        $scheduledClasses->each(function ($class) {
            $class->update([
                // 'date_time' => $class->date_time->addDay(1)
                'date_time' => $class->date_time->addDay($this->option('days')) // Increment by the number of days user specified in the option through console
            ]);
        });

        $this->info("All scheduled classes date has been incremented by {$this->option('days')} days");
    }
}
