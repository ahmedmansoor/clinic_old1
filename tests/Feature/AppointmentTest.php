<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Doctor;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_a_user()
    {
        $this->withExceptionHandling();
        // create new user
        $user = User::factory()->create();
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $this->actingAs($user);

        $response = $this->get('/dashboard/users');
        $response->assertStatus(200);
    }

    /** @test */
    public function create_a_doctor()
    {
        // create a new user and act as a user
        $user = User::factory()->create();
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $this->actingAs($user);

        // create new doctor
        Doctor::factory()->create();

        $response = $this->get('/dashboard/doctors');
        $response->assertStatus(200);
    }

    /** @test */
    public function create_a_session()
    {
        $this->withExceptionHandling();

        // create a new user and act as a user
        $user = User::factory()->create();
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $this->actingAs($user);

        // create new doctor
        Doctor::factory()->create();

        $user = User::first();
        $doctor = Doctor::first();
        $session = Session::first();

        $response = $this->post('/sessions', [
            'doctor_id' => $doctor->id,
            'user_id' => $user->id,
            // 'time_start' => '2022-08-17 13:32:03',
            // 'time_end' => '2022-08-17 13:32:03'
        ]);

        $response->assertStatus(302);

        $this->assertEquals(1, Session::count());

        $this->assertEquals($doctor->id, $session->doctor_id);
        $this->assertEquals($user->id, $session->user_id);
    }


    // create session / work hours (duty roster)
    // assign room to session
    // - assign doctor
    // - 15 patients a day - 30 mins per patient - 450 mins (7.5 hrs) per day 
    // create new patient
    // create appointment
    // - check availability via session or doctor->session
    // - if available deduct 30 mins from session (update available time)
    // - create prescription (medication, tests, scan, advice, more info, admission)

}