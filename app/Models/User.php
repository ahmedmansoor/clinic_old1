<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\Authenticatable;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_role_id',
        'user_status_id',
        'name',
        'nid',
        'gender',
        'address',
        'street',
        'island',
        'atoll',
        'city',
        'country',
        'phone_number',
        'email',
        'dob',
        'marital_status',
        'emergency_contact',
        'emergency_contact_number',
        'last_login',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Accessor for Age.
     */
    public function age()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Accessor for Age.
     */
    protected $appends = ['age', 'month'];

    public function getMonthAttribute()
    {
        return Carbon::parse($this->dob)->diffInMonths();
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }
}
