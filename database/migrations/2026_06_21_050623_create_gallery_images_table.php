<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table already exists from partial migration run
        if (!Schema::hasTable('gallery_images')) {
            Schema::create('gallery_images', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignUuid('gallery_id')->constrained('galleries')->cascadeOnDelete();
                $table->string('image_path');
                $table->timestamps();
            });
        }

        // Migrate existing galleries image paths to the new table
        $galleries = DB::table('galleries')->get();
        foreach ($galleries as $gallery) {
            if (!empty($gallery->image_path)) {
                DB::table('gallery_images')->insert([
                    'id' => (string) Str::uuid(),
                    'gallery_id' => $gallery->id,
                    'image_path' => $gallery->image_path,
                    'created_at' => $gallery->created_at ?? now(),
                    'updated_at' => $gallery->updated_at ?? now(),
                ]);
            }
        }

        // Drop image_path column from galleries table
        if (Schema::hasColumn('galleries', 'image_path')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->dropColumn('image_path');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-add the image_path column to galleries
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('image_path')->nullable();
        });

        // Restore the first image path from gallery_images to galleries
        $images = DB::table('gallery_images')
            ->orderBy('created_at', 'asc')
            ->get();
            
        $groupedImages = $images->groupBy('gallery_id');

        foreach ($groupedImages as $galleryId => $galleryImages) {
            $firstImage = $galleryImages->first();
            if ($firstImage) {
                DB::table('galleries')
                    ->where('id', $galleryId)
                    ->update(['image_path' => $firstImage->image_path]);
            }
        }

        Schema::dropIfExists('gallery_images');
    }
};
