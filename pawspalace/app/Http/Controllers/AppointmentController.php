<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'title' => 'Appointment - PawsPalace',
            'subtitle' => 'Schedule appointmens',
            'appointments' => Appointment::all(),
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
            'status' => $request->input('status'),
            'modality' => $request->input('modality'),
            'price' => $request->input('price'),
        ]);

        $request->session()->put('appointments', [$appointment->getId() => 1]);

        return redirect()->route('cart.index');
    }
}
