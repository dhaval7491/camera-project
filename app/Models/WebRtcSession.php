<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebRtcSession extends Model
{
    use HasFactory;

    protected $table = 'web_rtc_sessions';

    protected $fillable = [
        'room_id',
        'offer',
        'answer',
    ];
}
