<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [

        'filename',
        'filesize'
    ];

    protected $casts = [
        
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
