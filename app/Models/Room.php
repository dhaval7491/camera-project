<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'offer', 'answer'];

    protected $casts = [
        'offer' => 'array',
        'answer' => 'array',
    ];

    public function iceCandidates()
    {
        return $this->hasMany(IceCandidate::class);
    }
}
