<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        'description',
        'author_id',
        'screenshot_id'
    ];

    protected $casts = [

        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}