<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(): View
    {
        $pendingAppointments = Appointment::where('status', 'pendiente')->get();

        $viewData = [
            'title' => Lang::get('controllers.appointment_title'),
            'subtitle' => Lang::get('controllers.appointment_subtitle'),
            'appointments' => $pendingAppointments,
        ];

        return view('appointment.index')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        Appointment::validate($request);

        $appointment = Appointment::create([
            'duration' => $request->input('duration'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'status' => 'pendiente',
            'modality' => $request->input('modality'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('cart.index');
    }
}
