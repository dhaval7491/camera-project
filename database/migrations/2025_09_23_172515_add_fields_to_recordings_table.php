<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('recordings', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('recording_name');
            $table->string('s3_path')->nullable()->after('file_path');
            $table->string('s3_bucket')->nullable()->after('s3_path');
            $table->bigInteger('file_size')->nullable()->after('s3_bucket');
            $table->integer('duration')->nullable()->after('file_size');
            $table->string('format')->nullable()->after('duration');
            $table->string('status')->default('pending')->after('format');
            $table->json('metadata')->nullable()->after('status');
            $table->timestamp('processed_at')->nullable()->after('metadata');
            $table->index('status');
            $table->index('processed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recordings', function (Blueprint $table) {
            $table->dropColumn([
                'file_path',
                's3_path',
                's3_bucket',
                'file_size',
                'duration',
                'format',
                'status',
                'metadata',
                'processed_at'
            ]);
        });
    }
};
