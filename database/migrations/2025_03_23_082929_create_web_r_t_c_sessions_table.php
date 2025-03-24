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
        Schema::create('web_rtc_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('room_id')->unique();
            $table->longText('offer')->nullable();  // Using longText for large JSON data
            $table->longText('answer')->nullable(); // Using longText for large JSON data
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_r_t_c_sessions');
    }
};
