<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    // statuses
    public const SUPER_ADMIN = 1;
    public const ADMIN = 2;
    public const DOCTOR = 3;
    public const DESK = 4;
    public const PATIENT = 5;
}