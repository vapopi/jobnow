<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    
    protected $fillable = [

        'title',
        'description',
        'company_id',
        'professional_area_id'
    ];

    protected $casts = [

        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}