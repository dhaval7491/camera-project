<?php

namespace Database\Seeders;

use App\Models\Alert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alert::create([
            'title' => 'System Maintenance',
            'description' => 'Scheduled maintenance on Sunday at 2 AM.',
        ]);

        Alert::create([
            'title' => 'Security Update',
            'description' => 'New security updates have been applied.',
        ]);

        Alert::create([
            'title' => 'Feature Release',
            'description' => 'A new dashboard feature is now available.',
        ]);
    }
}
