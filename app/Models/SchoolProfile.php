<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'history',
        'vision',
        'mission',
        'principal_name',
        'principal_greeting',
        'principal_photo',
        'address',
        'phone',
        'email',
        'logo',
    ];
}
