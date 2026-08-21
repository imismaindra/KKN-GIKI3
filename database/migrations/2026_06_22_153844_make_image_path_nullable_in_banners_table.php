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
        Schema::table('banners', function (Blueprint $table) {
            $table->string('image_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Set null values to a default before making the column non-nullable
        DB::table('banners')->whereNull('image_path')->update(['image_path' => '']);
        Schema::table('banners', function (Blueprint $table) {
            $table->string('image_path')->nullable(false)->change();
        });
    }
};
