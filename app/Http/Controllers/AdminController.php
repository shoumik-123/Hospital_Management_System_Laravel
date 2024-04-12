<?php

namespace App\Http\Controllers;

use App\Models\Appiontment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addView()
    {
        return view('admin.add_doctor');
    }

    public function uploadDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:11',
            'roomNumber' => 'required|string|max:50',
            'speciality' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $doctor = new Doctor;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('doctorImages'), $imageName);
            $doctor->image = $imageName;
        }

        $doctor->name = $request->name;
        $doctor->phone = $request->number;
        $doctor->roomNumber = $request->roomNumber;
        $doctor->speciality = $request->speciality;

        $doctor->save();

        return redirect()->back()->with('success', 'Doctor added successfully.');
    }

    public function showAppointments()
    {
        $data = Appiontment::all();
        return view('admin.showAppointment' , compact('data'));
    }

    public function approveAppointments($id)
    {
        $data = Appiontment::find($id);
        $data->status = 'Approved';
        $data->save();

        return redirect()->back();
    }

    public function cancelAppointments($id)
    {
        $data = Appiontment::find($id);
        $data->status = 'Canceled';
        $data->save();

        return redirect()->back();
    }

    public function showDoctor()
    {
        $data = Doctor::all();
        return view('admin.showDoctor' , ['data' => $data]);
    }

    public function deleteDoctor($id)
    {
        $data = Doctor::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Doctor Deleted successfully.');
    }
    public function updateDoctor($id)
    {
       return view('admin.updateDoctorsProfile');
    }
}
