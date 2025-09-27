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
        'file_path',
        's3_path',
        's3_bucket',
        'file_size',
        'duration',
        'format',
        'status',
        'metadata',
        'processed_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'processed_at' => 'datetime',
        'metadata' => 'array',
        'file_size' => 'integer',
        'duration' => 'integer',
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
        // Get bucket and region from environment
        $bucket = env('AWS_BUCKET', 'your-camera-recordings-bucket');
        $region = env('AWS_DEFAULT_REGION', 'us-east-1');

        // If we have a full S3 path, use it, otherwise construct the path
        if (filter_var($this->s3_path, FILTER_VALIDATE_URL)) {
            return $this->s3_path;
        }

        $path = $this->s3_path ?? "recordings/{$this->camera_id}/{$this->recording_name}";

        // Return direct public S3 URL
        return "https://{$bucket}.s3.{$region}.amazonaws.com/{$path}";
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