<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    // statuses
    public const NEW = 1;
    public const ACTIVE = 2;
    public const INACTIVE = 3;
    public const DISMISSED = 4;
}