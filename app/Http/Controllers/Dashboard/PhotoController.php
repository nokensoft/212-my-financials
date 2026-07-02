<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    use HandlesUploads;

    public function store(Request $request, Album $album): RedirectResponse
    {
        $request->validate([
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'max:4096'],
        ], [], ['images.*' => 'foto']);

        $order = (int) $album->photos()->max('sort_order');

        foreach ($request->file('images', []) as $file) {
            $order++;
            $album->photos()->create([
                'image_path' => $this->storePublicImage($file, 'uploads/photos'),
                'sort_order' => $order,
            ]);
        }

        // Jadikan foto pertama sebagai sampul bila album belum punya sampul.
        if (! $album->cover_image && $first = $album->photos()->orderBy('sort_order')->first()) {
            $album->update(['cover_image' => $first->image_path]);
        }

        return back()->with('status', 'Foto berhasil ditambahkan.');
    }

    public function destroy(Album $album, Photo $photo): RedirectResponse
    {
        abort_unless($photo->album_id === $album->id, 404);

        $this->deletePublicImage($photo->image_path);
        $photo->delete();

        return back()->with('status', 'Foto berhasil dihapus.');
    }
}
