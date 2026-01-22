<?php

namespace App\Http\Controllers\Calender;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppointmentController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        Appointment::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'all_day' => 'boolean',
        ]);

        $appointment->update($validated);

        return redirect()->back();
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->back();
    }
}
