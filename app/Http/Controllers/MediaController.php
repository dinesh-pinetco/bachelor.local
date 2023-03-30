<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function show(Media $media)
    {
        $this->authorize('view', $media);

        return Storage::response($media->path);
    }

    public function getStorageFile()
    {
        $storagePath = str_replace('storage', '', request('path'));

        return Storage::response($storagePath);
    }
}
