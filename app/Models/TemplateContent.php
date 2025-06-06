<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateContent extends Model
{
    use HasFactory;
    protected $table = 'template_contents';
    protected $fillable = [
        'user_id',
        'template_id',
        'data',
    ];

    protected $casts = [
        'data' => 'array', // Automatically decode JSON to array
    ];
}
