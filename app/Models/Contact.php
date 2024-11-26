<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'position',
        'email',
        'phone',
        'office_phone',
        'address',
        'organization',
        'profile_image',
        'country',
        'social',
    ];

    protected $casts = [
        'social' => 'array', // แปลงข้อมูล JSON เป็น array
    ];
}
