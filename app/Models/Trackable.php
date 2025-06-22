<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trackable extends Model
{
    protected $fillable = [
        'trackable_name',
        'project_id',
        'other_name',
        'status',
    ];

    public function linkedObjects()
    {
        return $this->hasMany(LinkedObject::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_trackable')->withTimestamps();
    }
}
