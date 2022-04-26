<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'password',
        'email',
        'logo_id',
        'role_id'
    ];

    protected $hidden = [

        'password',
        'remember_token'

    ];

    protected $casts = [

        'email_verified_at' => 'datetime',
        'creation_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
