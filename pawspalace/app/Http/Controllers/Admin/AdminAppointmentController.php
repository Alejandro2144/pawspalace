<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAppointmentController extends Controller
{
    public function index()
    {
        $viewData = [
            'title' => 'Admin Page - Appointment - PawsPalace',
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
        $newAppointment->setReason($request->input('reason'));
        $newAppointment->setImage('game.png');
        $newAppointment->save();

        if ($request->hasFile('image')) {
            $imageName = $newAppointment->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newAppointment->setImage($imageName);
            $newAppointment->save();
        }

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
            'title' => 'Admin Page - Edit Appointment - PawsPalace',
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
        $appointment->setReason($request->input('reason'));

        if ($request->hasFile('image')) {
            $imageName = $appointment->getId().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $appointment->setImage($imageName);
        }

        $appointment->save();

        return redirect()->route('admin.appointment.index');
    }
}
