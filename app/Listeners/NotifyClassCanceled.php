<?php

namespace App\Listeners;

use App\Events\ClassCanceled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyClassCanceled
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassCanceled $event): void
    {
        $scheduledClass = $event->scheduledClass;
        Log::info($scheduledClass->classType->name . ' class canceled');

        // $scheduledClass->members->each(function ($member) use ($scheduledClass) {
        //     $member->notify(new ClassCanceledNotification($scheduledClass));
        // });
    }
}
