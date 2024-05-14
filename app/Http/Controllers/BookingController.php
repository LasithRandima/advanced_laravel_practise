<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create() {
        $scheduledClasses = ScheduledClass::where('date_time', '>', now())
            ->with('classType', 'instructor') // eager loading relationships
            // In members relationship current logged member classes doesn't show because of this
            // Querying Relationship Absence
            ->whereDoesntHave('members', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->oldest()->get();
        return view('member.book')->with('scheduledClasses', $scheduledClasses);
    }

    public function store(Request $request) {
        // attaching relationship (works only for many-to-many relationships)
        auth()->user()->bookings()->attach($request->scheduled_class_id);

        return redirect()->route('booking.index');
    }

    public function index() {
        $bookings = auth()->user()->bookings()->where('date_time', '>', now())->get();

        return view('member.upcoming')->with('bookings',$bookings);
    }

    public function destroy(int $id) {
        //detaching relationship (works only for many-to-many relationships)
        auth()->user()->bookings()->detach($id); // remove the booking  from the bookings table

        return redirect()->route('booking.index');
    }


}
