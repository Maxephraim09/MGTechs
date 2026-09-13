<?php

namespace App\Traits;

trait HandlesFiles
{
    /**
     * Upload a file to storage/app/public/$directory.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string|null Stored relative path
     */
    public function uploadFile(\Illuminate\Http\UploadedFile $file, string $directory): ?string
    {
        $path = $file->store($directory, 'public');
        return is_string($path) ? $path : null;
    }

    /**
     * Delete a previously stored file from storage/app/public/$path.
     *
     * @param string $path Relative path inside the public disk
     */
    public function deleteFile(string $path): bool
    {
        $fullPath = storage_path('app/public/' . ltrim($path, '/'));
        if (!file_exists($fullPath)) {
            return false;
        }

        return unlink($fullPath);
    }
}

