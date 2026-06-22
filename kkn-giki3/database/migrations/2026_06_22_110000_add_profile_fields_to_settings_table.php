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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('about_title')->nullable()->after('mission');
            $table->text('about_description')->nullable()->after('about_title');
            $table->string('about_image')->nullable()->after('about_description');
            $table->string('about_year_founded', 10)->default('1993')->after('about_image');
            $table->string('about_accreditation', 50)->default('Akreditasi A')->after('about_year_founded');
            $table->string('about_card_title')->default('Pendidikan Holistik & Karakter')->after('about_accreditation');
            $table->text('about_card_desc')->nullable()->after('about_card_title');

            $table->string('headmaster_name')->default('Drs. H. M. Zainuri, M.Si')->after('about_card_desc');
            $table->string('headmaster_title')->default('Kepala SMA GIKI 3 Surabaya')->after('headmaster_name');
            $table->string('headmaster_photo')->nullable()->after('headmaster_title');
            $table->string('headmaster_speech_title')->default('Menyiapkan Generasi Unggul & Berkarakter Mulia')->after('headmaster_photo');
            $table->text('headmaster_speech')->nullable()->after('headmaster_speech_title');

            $table->text('maps_embed')->nullable()->after('youtube_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'about_title',
                'about_description',
                'about_image',
                'about_year_founded',
                'about_accreditation',
                'about_card_title',
                'about_card_desc',
                'headmaster_name',
                'headmaster_title',
                'headmaster_photo',
                'headmaster_speech_title',
                'headmaster_speech',
                'maps_embed'
            ]);
        });
    }
};
