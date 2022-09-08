<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Models\Doctor;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $doctors = Doctor::latest()->paginate(5);
        // $doctors->load('user');
        // dd($doctors);

        $doctors = Doctor::with('user')->paginate(5);

        return inertia('Doctors/Index', ['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Doctors/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            User::create([
                'user_role_id' => UserRole::DOCTOR,
                'user_status_id' => UserStatus::NEW,
                'name' => $request->name,
                'nid' => $request->nid,
                'gender' => $request->gender,
                'address' => $request->address,
                'island' => $request->island,
                'atoll' => $request->atoll,
                'city' => $request->city,
                'country' => $request->country,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'dob' => $request->dob,
                'marital_status' => $request->marital_status,
                'emergency_contact' => $request->emergency_contact,
                'emergency_contact_number' => $request->emergency_contact_number,
                'password' => 'Doctor321*'
            ]);

            Doctor::create([
                'user_id' => User::where('nid', $request->nid)->value('id'),
                'specialty_id' => "1",
                // 'specialty_id' => $request->specialty_id,
                'registration_number' => $request->registration_number
            ]);
            DB::commit();
            return back()->with('success', 'Doctor Added Successfully');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            // Log::info($e->getMessage());
            return back()->with('error', 'An error occurred');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
