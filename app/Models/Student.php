<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;
    // use Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'first_name',
        'last_name', 
        'username',
        's_mobile',
        'f_mobile',
        'email', 
        'password',
        'created_at',
        'updated_at',
        'gender',
        'father_name',
        'mother_name',
        'address',
        'country',
        'state',
        'city',
        'pincode',
        'collage_name',
        'qualification',
        'course_type',
        'course_name',
        'batch_start',
        'image',
        'student_type',
        'category',
        'is_active',
        'school_name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
