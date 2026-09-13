<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index()
    {
        return view('admin.content.index', [
            'items' => MediaItem::with('author')->latest()->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.content.create');
    }

    public function store(Request $request)
    {
        $item = MediaItem::create($this->validatedData($request) + [
            'user_id' => $request->user()->id,
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? now() : null,
        ]);

        $this->storeUpload($request, $item);

        return redirect()->route('admin.content.index')->with('success', 'Content saved.');
    }

    public function edit(MediaItem $content)
    {
        return view('admin.content.edit', ['item' => $content]);
    }

    public function update(Request $request, MediaItem $content)
    {
        $content->update($this->validatedData($request) + [
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? ($content->published_at ?? now()) : null,
        ]);

        $this->storeUpload($request, $content);

        return redirect()->route('admin.content.index')->with('success', 'Content updated.');
    }

    public function destroy(MediaItem $content)
    {
        if ($content->file_path) {
            Storage::disk('public')->delete($content->file_path);
        }

        $content->delete();

        return back()->with('success', 'Content deleted.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'type' => 'required|in:text,pdf,image,audio,video',
            'summary' => 'nullable|string|max:1000',
            'body' => 'nullable|string',
            'external_url' => 'nullable|url|max:2048',
            'upload' => 'nullable|file|max:51200',
        ]);

        $validated['slug'] = $this->uniqueSlug($validated['slug'] ?? $validated['title'], $request->route('content'));

        if ($validated['type'] !== 'video') {
            $validated['external_url'] = null;
        }

        return $validated;
    }

    private function storeUpload(Request $request, MediaItem $item): void
    {
        if (!$request->hasFile('upload')) {
            return;
        }

        if ($item->file_path) {
            Storage::disk('public')->delete($item->file_path);
        }

        $file = $request->file('upload');
        $item->update([
            'file_path' => $file->store('content/'.$item->type, 'public'),
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
        ]);
    }

    private function uniqueSlug(string $source, ?MediaItem $ignore = null): string
    {
        $base = Str::slug($source) ?: Str::random(8);
        $slug = $base;
        $count = 2;

        while (MediaItem::where('slug', $slug)->when($ignore, fn ($query) => $query->whereKeyNot($ignore->id))->exists()) {
            $slug = $base.'-'.$count++;
        }

        return $slug;
    }
}
