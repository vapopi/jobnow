<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [

        'message',
        'author_id',
        'receiver_id',
        'group_id'
    ];

    protected $casts = [

        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}