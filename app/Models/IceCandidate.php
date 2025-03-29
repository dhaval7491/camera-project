<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IceCandidate extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'type', 'candidate'];

    protected $casts = [
        'candidate' => 'array',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
