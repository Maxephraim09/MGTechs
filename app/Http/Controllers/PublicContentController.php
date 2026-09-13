<?php

namespace App\Http\Controllers;

use App\Models\MediaItem;
use Illuminate\Support\Facades\Storage;

class PublicContentController extends Controller
{
    public function index()
    {
        return view('content.index', [
            'items' => MediaItem::published()->latest('published_at')->paginate(12),
        ]);
    }

    public function show(MediaItem $content)
    {
        abort_unless($content->is_published, 404);

        $content->increment('views_count');

        return view('content.show', ['item' => $content->fresh()]);
    }

    public function download(MediaItem $content)
    {
        abort_unless($content->is_published && $content->file_path, 404);

        $content->increment('downloads_count');

        return Storage::disk('public')->download($content->file_path, $content->file_name);
    }
}
