<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkedObject extends Model
{
    protected $fillable = [
        'trackable_id',
        'name',
    ];

    public function trackable()
    {
        return $this->belongsTo(Trackable::class);
    }
}
