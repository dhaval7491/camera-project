<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Recording extends Model
{
    use HasFactory;

    protected $fillable = [
        'camera_id',
        'recording_timestamp',
        'recording_name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the equipment/camera that owns this recording
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'camera_id', 'id');
    }

    /**
     * Alias for equipment relationship (for clarity)
     */
    public function camera()
    {
        return $this->equipment();
    }

    /**
     * Get recordings by camera ID
     */
    public function scopeByCameraId($query, $cameraId)
    {
        return $query->where('camera_id', $cameraId);
    }

    /**
     * Get recordings by equipment code (if you store camera identifier in equipment_code)
     */
    public function scopeByEquipmentCode($query, $equipmentCode)
    {
        return $query->whereHas('equipment', function($q) use ($equipmentCode) {
            $q->where('equipment_code', $equipmentCode);
        });
    }

    /**
     * Get recordings by date range
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Get recent recordings
     */
    public function scopeRecent($query, $hours = 24)
    {
        return $query->where('created_at', '>=', Carbon::now()->subHours($hours));
    }

    /**
     * Get formatted recording timestamp for display
     */
    public function getFormattedTimestampAttribute()
    {
        // Convert Unix timestamp to readable format
        return Carbon::createFromTimestamp($this->recording_timestamp)->format('Y-m-d H:i:s');
    }

    /**
     * Get the S3 URL for the recording (if needed)
     */
    public function getS3UrlAttribute()
    {
        // Construct S3 URL based on your bucket structure
        return "https://your-bucket-name.s3.amazonaws.com/recordings/{$this->camera_id}/{$this->recording_name}";
    }

    /**
     * Get camera name from equipment
     */
    public function getCameraNameAttribute()
    {
        return $this->equipment ? $this->equipment->name : 'Unknown Camera';
    }

    /**
     * Get camera code from equipment
     */
    public function getCameraCodeAttribute()
    {
        return $this->equipment ? $this->equipment->equipment_code : null;
    }
}