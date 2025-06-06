<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateTemplate extends Model
{
    use HasFactory;
    protected $table = 'user_templates';
    protected $fillable = [
        'title',
        'description',
        'domain',
        'design',
        'user_id',
        'template_id',
        'thumbnail',
    ];

}
