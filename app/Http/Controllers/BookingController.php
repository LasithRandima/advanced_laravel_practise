<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create() {
        // $scheduledClasses = ScheduledClass::where('date_time', '>', now())
        //     ->with('classType', 'instructor') // eager loading relationships
        //     // In members relationship current logged member classes doesn't show because of this. all other exclude classes will show
        //     // Querying Relationship Absence
        //     ->whereDoesntHave('members', function ($query) {
        //         $query->where('user_id', auth()->id());
        //     })
        //     ->oldest()->get();


        // using query scopes - upcoming
        $scheduledClasses = ScheduledClass::upcoming()
        ->with('classType', 'instructor') // eager loading relationships
        // In members relationship current logged member classes doesn't show because of this. all other exclude classes will show
        // Querying Relationship Absence
        ->notBooked()
        ->oldest('date_time')->get();
        return view('member.book')->with('scheduledClasses', $scheduledClasses);
    }

    public function store(Request $request) {
        // attaching relationship (works only for many-to-many relationships)
        //The attach method is primarily used in many-to-many relationships to add records to the pivot table that connects two models.
        auth()->user()->bookings()->attach($request->scheduled_class_id);

        return redirect()->route('booking.index');
    }

    public function index() {
        // $bookings = auth()->user()->bookings()->where('date_time', '>', now())->get();

         // using query scopes - upcoming
        $bookings = auth()->user()->bookings()->upcoming()->get();

        return view('member.upcoming')->with('bookings',$bookings);
    }

    public function destroy(int $id) {
        //detaching relationship (works only for many-to-many relationships)
        // the detach method allows we to remove records from a many-to-many relationship's pivot table
        auth()->user()->bookings()->detach($id); // remove the booking  from the bookings table

        return redirect()->route('booking.index');
    }


}
