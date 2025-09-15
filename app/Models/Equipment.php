<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Equipment extends Model implements AuthenticatableContract
{
    use HasFactory, HasApiTokens, Authenticatable;
    protected $table = "equipments";
    protected $fillable = [
        'type',
        'equipment_name',
        'stream_link',
        'equipment_code',
        'password'
    ];

    public function mappingAsCamera()
    {
        return $this->hasOne(Mapping::class, 'camera_id');
    }

    public function mappingAsTablet()
    {
        return $this->hasOne(Mapping::class, 'tablet_id');
    }

    /**
     * Get all recordings for this equipment/camera
     */
    public function recordings()
    {
        return $this->hasMany(Recording::class, 'camera_id', 'id');
    }
}
