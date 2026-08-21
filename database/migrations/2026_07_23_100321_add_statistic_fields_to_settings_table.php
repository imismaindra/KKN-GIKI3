<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->integer('stat_students')->default(1000);
            $table->integer('stat_teachers')->default(80);
            $table->integer('stat_achievements')->default(50);
            $table->integer('stat_years')->default(25);
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['stat_students', 'stat_teachers', 'stat_achievements', 'stat_years']);
        });
    }
};
