<?php

namespace App\Listeners;

use App\Events\ClassCanceled;
use App\Jobs\NotifyClassCanceledjob;
use App\Mail\ClassCanceledMail;
use App\Notifications\ClassCanceledNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
        // $scheduledClass = $event->scheduledClass;
        // Log::info($scheduledClass->classType->name . ' class canceled');

        // $scheduledClass->members->each(function ($member) use ($scheduledClass) {
        //     $member->notify(new ClassCanceledNotification($scheduledClass));
        // });

        $members = $event->scheduledClass->members()->get();

        $className = $event->scheduledClass->classType->name;
        $classDateTime = $event->scheduledClass->date_time;

        $details = compact('className', 'classDateTime');


        // $members->each(function($user) use ($details){
        //     Mail::to($user)->send(new ClassCanceledMail($details));
        // });

        //instead of sending mail to each member directly, we can send notification
        // Notification::send($members, new ClassCanceledNotification($details));

        // we should use jobs to send notifications to multiple users because they are time-consuming. we have to send notification as background process
        NotifyClassCanceledjob::dispatch($members, $details);
    }
}
