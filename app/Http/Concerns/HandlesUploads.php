<?php

namespace App\Http\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesUploads
{
    /**
     * Store an uploaded image on the public disk and return a web-usable
     * relative path (e.g. "storage/uploads/covers/abc.jpg").
     */
    protected function storePublicImage(?UploadedFile $file, string $dir): ?string
    {
        if (! $file) {
            return null;
        }

        $path = $file->store($dir, 'public');

        return 'storage/'.$path;
    }

    /**
     * Delete a previously stored public image given its web-usable path.
     */
    protected function deletePublicImage(?string $webPath): void
    {
        if ($webPath && str_starts_with($webPath, 'storage/')) {
            Storage::disk('public')->delete(substr($webPath, strlen('storage/')));
        }
    }
}
