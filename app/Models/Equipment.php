<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Equipment extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "equipments";
    protected $fillable = [
        'type',
        'camera_name',
        'stream_link',
        'camera_code',
        'map_tablet',
        'password'
    ];
}
