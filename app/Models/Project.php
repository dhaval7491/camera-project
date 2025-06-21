<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'is_active'];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_project');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
}
