<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $patients = Patient::paginate(15)->through(function ($patient) {
        //     return [
        //         'name' => $patient->name,
        //         'nid' => $patient->nid,
        //         'gender' => $patient->gender,
        //         'address' => $patient->address,
        //         'island' => $patient->island,
        //         'atoll' => $patient->atoll,
        //         'city' => $patient->city,
        //         'country' => $patient->country,
        //         'phone_number' => $patient->phone_number,
        //         'email' => $patient->email,
        //         'dob' => $patient->dob,
        //         'marital_status' => $patient->marital_status,
        //         'emergency_contact' => $patient->emergency_contact,
        //         'emergency_contact_number' => $patient->emergency_contact_number,
        //         'drug_allergies' => $patient->drug_allergies,
        //         'food_allergies' => $patient->food_allergies,
        //     ];
        // });

        // return inertia('Patients/Index', ['items' => $patients]);

        // return inertia('Patients/Index', [
        //     'patients' => Patient::paginate(15)
        // ]);

        // return inertia('Patients/Index', compact('patients'));

        $patients = Patient::latest()->paginate(5);

        return inertia('Patients/Index', ['patients' => $patients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Patients/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatientRequest $request)
    {
        try {
            Patient::create($request->validated());
            return redirect()->route('patients.index')->with('success', 'Patient Added Successfully');
        } catch (Exception $e) {
            // Log::info($e->getMessage());
            return back()->with('error', 'An error occurred');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        // dd($patient->name);
        return inertia('Patients/Edit', compact('patient'));
        // return inertia('Patients/Edit', [
        //     'patient' => [
        //         'name' => $patient->name,
        //         'nid' => $patient->nid,
        //         'gender' => $patient->gender,
        //         'address' => $patient->address,
        //         'island' => $patient->island,
        //         'atoll' => $patient->atoll,
        //         'city' => $patient->city,
        //         'country' => $patient->country,
        //         'phone_number' => $patient->phone_number,
        //         'email' => $patient->email,
        //         'dob' => $patient->dob,
        //         'marital_status' => $patient->marital_status,
        //         'emergency_contact' => $patient->emergency_contact,
        //         'emergency_contact_number' => $patient->emergency_contact_number,
        //         'drug_allergies' => $patient->drug_allergies,
        //         'food_allergies' => $patient->food_allergies,
        //     ]
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        // dd('ss');
        $patient->update($request->validated());

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, $id)
    {
        try {
            Patient::where('id', $id)->delete();
            return back()->with('success', 'Patient Deleted Successfully');
        } catch (Exception $e) {
            // Log::info($e->getMessage());
            return back()->with('error', 'An error occurred');
        }
    }
}
