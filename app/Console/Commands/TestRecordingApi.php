<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Recording;

class TestRecordingApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recording:test {--camera-id=23} {--timestamp=} {--s3-path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the recording API endpoint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cameraId = $this->option('camera-id');
        $timestamp = $this->option('timestamp') ?: now()->format('Y-m-d H:i:s');
        $s3Path = $this->option('s3-path') ?: 'recordings/' . $cameraId . '/' . date('Y/m') . '/test_' . time() . '.mp4';

        $this->info('Testing Recording API...');
        $this->info('Camera ID: ' . $cameraId);
        $this->info('Timestamp: ' . $timestamp);
        $this->info('S3 Path: ' . $s3Path);

        // Test API endpoint
        $apiUrl = config('app.url') . '/api/janus/recording/store';
        $apiToken = env('JANUS_API_TOKEN', 'test-token');

        try {
            $response = Http::withToken($apiToken)->post($apiUrl, [
                'camera_id' => $cameraId,
                'recording_timestamp' => $timestamp,
                'recording_name' => $s3Path
            ]);

            if ($response->successful()) {
                $this->info('✅ API call successful!');
                $this->info('Response: ' . $response->body());

                // Check database
                $recording = Recording::where('camera_id', $cameraId)
                    ->where('recording_timestamp', $timestamp)
                    ->first();

                if ($recording) {
                    $this->info('✅ Recording found in database!');
                    $this->table(
                        ['ID', 'Camera ID', 'Timestamp', 'S3 Path'],
                        [[$recording->id, $recording->camera_id, $recording->recording_timestamp, $recording->recording_name]]
                    );
                }
            } else {
                $this->error('❌ API call failed!');
                $this->error('Status: ' . $response->status());
                $this->error('Response: ' . $response->body());
            }
        } catch (\Exception $e) {
            $this->error('❌ Exception occurred: ' . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}