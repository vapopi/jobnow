<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'logo_id',
        'author_id',
        'company_id'
    ];

    protected $casts = [

        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}