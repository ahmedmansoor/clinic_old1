<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        'drug_allergies',
        'food_allergies',
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
