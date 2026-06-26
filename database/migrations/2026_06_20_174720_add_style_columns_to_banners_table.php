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
            $table->string('alignment', 20)->default('left');
            $table->string('cta_color', 30)->default('amber');
            $table->integer('overlay_opacity')->default(60);
            $table->string('text_color', 20)->default('light');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['alignment', 'cta_color', 'overlay_opacity', 'text_color']);
        });
    }
};
