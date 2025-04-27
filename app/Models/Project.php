<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id', 'user_id', 'location', 'plant_name'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
