<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AdminAppointmentController extends Controller
{
    public function index()
    {
        $viewData = [
            'title' => Lang::get('controllers.admin_appointment.index_title'),
            'appointments' => Appointment::all(),
        ];

        return view('admin.appointment.index')->with('viewData', $viewData);
    }

    public function store(Request $request)
    {
        Appointment::validate($request);

        $newAppointment = new Appointment();
        $newAppointment->setStatus($request->input('status'));
        $newAppointment->setDuration($request->input('duration'));
        $newAppointment->setPrice($request->input('price'));
        $newAppointment->setModality($request->input('modality'));
        $newAppointment->setDate($request->input('date'));
        $newAppointment->setTime($request->input('time'));
        $newAppointment->setImage('game.png');
        $newAppointment->save();

        return back();
    }

    public function delete($id)
    {
        Appointment::destroy($id);

        return back();
    }

    public function edit($id)
    {
        $viewData = [
            'title' => Lang::get('controllers.admin_appointment.edit_title'),
            'appointment' => Appointment::findOrFail($id),
        ];

        return view('admin.appointment.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id)
    {
        Appointment::validate($request);

        $appointment = Appointment::findOrFail($id);
        $appointment->setStatus($request->input('status'));
        $appointment->setDuration($request->input('duration'));
        $appointment->setPrice($request->input('price'));
        $appointment->setModality($request->input('modality'));
        $appointment->setDate($request->input('date'));
        $appointment->setTime($request->input('time'));

        $appointment->save();

        return redirect()->route('admin.appointment.index');
    }
}
