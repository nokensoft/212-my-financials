<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    use HandlesUploads;

    /**
     * Endpoint unggah gambar untuk TinyMCE (images_upload_url).
     * Mengembalikan { "location": "<url>" } sesuai kontrak TinyMCE.
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'max:4096'],
        ]);

        $path = $this->storePublicImage($request->file('file'), 'uploads/content');

        return response()->json(['location' => asset($path)]);
    }
}
