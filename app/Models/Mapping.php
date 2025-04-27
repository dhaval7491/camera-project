<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapping extends Model
{
    use HasFactory;

    // Specify the table name (optional, Laravel uses the plural form by default)
    protected $table = 'mapping';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'company_id',
        'project_id',
        'equipment_id',
    ];

    // Define the relationship to the Company model (assuming you have a Company model)
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Define the relationship to the Project model (assuming you have a Project model)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Define the relationship to the Equipment model (assuming you have an Equipment model)
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
