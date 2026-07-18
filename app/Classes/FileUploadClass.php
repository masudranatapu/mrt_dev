<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FileUploadClass
{
    // Handle image uploads
    public function imageUploader($file, $path, $width = null, $height = null, $old_image = null)
    {
        if ($old_image) {
            $this->fileUnlink($old_image);
        }

        if (!$file || !$file->isValid()) {
            throw new \Exception('No valid image uploaded.');
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'svg', 'html', 'txt', 'docx', 'doc'];
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            throw new \Exception('File type not supported for image upload.');
        }

        $upload_path = 'public/' . strtolower($path) . '/' . date('Y-m-d') . '/';
        $fullUploadPath = storage_path('app/' . $upload_path);

        if (!file_exists($fullUploadPath)) {
            mkdir($fullUploadPath, 0777, true);
        }

        if ($extension === 'svg') {
            $file_name = strtolower($path) . '-' . uniqid() . '.svg';
            $file->move($fullUploadPath, $file_name);
        } else {
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file->getRealPath())->orient();

            if ($width && $height) {
                $img->scaleDown($width, $height);
            }

            $file_name = strtolower($path) . '-' . uniqid() . '.webp';
            $img->toWebp(90)->save($fullUploadPath . $file_name);
        }

        // Keep URL compatible with asset($path)
        $url = 'storage/' . str_replace('public/', '', $upload_path . $file_name);

        return $url;
    }

    // Handle PDF uploads
    public function pdfUploader($file, $path, $old_file = null, $width = null, $height = null)
    {
        // Delete old file if exists
        if ($old_file) {
            $this->fileUnlink($old_file);
        }

        if (!$file || !$file->isValid()) {
            throw new \Exception('No valid file uploaded.');
        }

        // Check extension
        $allowedExtensions = ['pdf'];
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            throw new \Exception('Only PDF files are allowed.');
        }

        // Check mime type
        $allowedMimes = ['application/pdf'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            throw new \Exception('Invalid PDF file type.');
        }

        $filename = strtolower($path) . '-' . uniqid() . '.pdf';
        $folder = strtolower($path) . '/' . date('Y-m-d');

        // Store file
        $stored = Storage::disk('public')->putFileAs(
            $folder,
            $file,
            $filename
        );

        if (!$stored) {
            throw new \Exception('Failed to save PDF file.');
        }

        // Return URL like old uploader
        $url = 'storage/' . $folder . '/' . $filename;

        return $url;
    }

    public function fileUnlink($path)
    {
        if (!$path) {
            false;
        }

        // If storage path (starts with storage/)
        if (str_starts_with($path, 'storage/')) {
            $storagePath = str_replace('storage/', '', $path);
            if (Storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->delete($storagePath);
                return true;
            }
        }

        // If normal full path
        if (file_exists($path)) {
            unlink($path);
            return true;
        }

        return false;
    }
}
