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

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia('Doctors');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Doctor/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(StoreDoctorRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',

        // ]);

        try {
            DB::beginTransaction();
            User::create([
                'user_role_id' => UserRole::DOCTOR,
                'user_status_id' => UserStatus::NEW,
                'name' => $request->name,
                'nid' => $request->nid,
                'address' => $request->address,
                'island' => $request->island,
                'atoll' => $request->atoll,
                'country' => $request->country,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'dob' => $request->dob,
                'marital_status' => $request->marital_status,
                'country' => $request->country,
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
            // dd($e->getMessage());
            DB::rollBack();
            // return response()->json($e->getMessage(), 422);
            return back()->with('error', $e->getMessage());
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
