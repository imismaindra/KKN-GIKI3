<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageOptimizer
{
    /**
     * Optimize and save an uploaded image file as WebP.
     *
     * @param UploadedFile $file The uploaded file.
     * @param string $directory Directory inside 'public' disk (e.g., 'galleries', 'banners').
     * @param int $maxWidth Maximum width of the image.
     * @param int $maxHeight Maximum height of the image.
     * @param int $quality Compression quality (0-100).
     * @return string|false The relative path of the optimized image (with .webp extension), or false on failure.
     */
    public static function optimize(UploadedFile $file, string $directory, int $maxWidth = 1200, int $maxHeight = 1200, int $quality = 75)
    {
        // If GD extension is not loaded, fallback to standard Laravel file storage
        if (!extension_loaded('gd')) {
            return $file->store($directory, 'public');
        }

        // Get original details
        $tempPath = $file->getRealPath();
        $imageInfo = getimagesize($tempPath);
        if (!$imageInfo) {
            return $file->store($directory, 'public');
        }

        list($width, $height, $type) = $imageInfo;

        // Calculate new dimensions to maintain aspect ratio
        $ratio = $width / $height;
        if ($width > $maxWidth || $height > $maxHeight) {
            if ($ratio > 1) {
                $newWidth = $maxWidth;
                $newHeight = (int) ($maxWidth / $ratio);
            } else {
                $newHeight = $maxHeight;
                $newWidth = (int) ($maxHeight * $ratio);
            }
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }

        // Create new image resource from source
        switch ($type) {
            case IMAGETYPE_JPEG:
                $srcImage = @imagecreatefromjpeg($tempPath);
                break;
            case IMAGETYPE_PNG:
                $srcImage = @imagecreatefrompng($tempPath);
                break;
            case IMAGETYPE_WEBP:
                $srcImage = @imagecreatefromwebp($tempPath);
                break;
            case IMAGETYPE_GIF:
                $srcImage = @imagecreatefromgif($tempPath);
                break;
            default:
                // Fallback for unsupported types
                return $file->store($directory, 'public');
        }

        if (!$srcImage) {
            return $file->store($directory, 'public');
        }

        // Create destination true color image
        $dstImage = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for PNG, WebP, and GIF
        if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_WEBP || $type == IMAGETYPE_GIF) {
            imagealphablending($dstImage, false);
            imagesavealpha($dstImage, true);
            $transparent = imagecolorallocatealpha($dstImage, 255, 255, 255, 127);
            imagefilledrectangle($dstImage, 0, 0, $newWidth, $newHeight, $transparent);
        }

        // Resize / Resample
        imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Generate a unique filename with .webp extension
        $filename = Str::random(40) . '.webp';
        $relativeWebpPath = $directory . '/' . $filename;
        $fullWebpPath = storage_path('app/public/' . $relativeWebpPath);

        // Ensure target directory exists in public storage
        $dirPath = dirname($fullWebpPath);
        if (!file_exists($dirPath)) {
            mkdir($dirPath, 0755, true);
        }

        // Save as WebP
        $success = imagewebp($dstImage, $fullWebpPath, $quality);

        // Free up memory resources
        imagedestroy($srcImage);
        imagedestroy($dstImage);

        return $success ? $relativeWebpPath : $file->store($directory, 'public');
    }
}
