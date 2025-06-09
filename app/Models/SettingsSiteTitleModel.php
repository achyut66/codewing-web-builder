<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsSiteTitleModel extends Model
{
    use HasFactory;
    protected $table = 'settings_site_title';
    protected $fillable = ['site_title', 'site_description', 'site_keywords', 'site_logo', 'favicon'];
    public $timestamps = false;
    protected $casts = [
        'site_title' => 'string',
        'site_description' => 'string',
        'site_keywords' => 'string',
        'site_logo' => 'string',
        'favicon' => 'string',
    ];
    protected $primaryKey = 'id';
}
