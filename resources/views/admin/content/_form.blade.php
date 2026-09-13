@csrf
@isset($item)
    @method('PUT')
@endisset

<div class="space-y-4">
    <div>
        <label class="block text-sm text-gray-300 mb-1">Title</label>
        <input name="title" value="{{ old('title', $item->title ?? '') }}" required class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-gray-300 mb-1">Slug</label>
            <input name="slug" value="{{ old('slug', $item->slug ?? '') }}" placeholder="auto-generated" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
        </div>
        <div>
            <label class="block text-sm text-gray-300 mb-1">Content Type</label>
            <select name="type" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
                @foreach(['text' => 'Text', 'pdf' => 'PDF', 'image' => 'Image', 'audio' => 'Audio', 'video' => 'Video Link'] as $value => $label)
                    <option value="{{ $value }}" {{ old('type', $item->type ?? 'text') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label class="block text-sm text-gray-300 mb-1">Summary</label>
        <textarea name="summary" rows="3" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">{{ old('summary', $item->summary ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm text-gray-300 mb-1">Text Content</label>
        <textarea id="body-editor" name="body" rows="10" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">{{ old('body', $item->body ?? '') }}</textarea>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm text-gray-300 mb-1">Upload File</label>
            <input type="file" name="upload" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
            @isset($item)
                @if($item->file_path)<p class="text-xs text-gray-500 mt-1">Current file: {{ $item->file_name }}</p>@endif
            @endisset
        </div>
        <div>
            <label class="block text-sm text-gray-300 mb-1">Video URL</label>
            <input type="url" name="external_url" value="{{ old('external_url', $item->external_url ?? '') }}" placeholder="https://youtube.com/..." class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white">
        </div>
    </div>
    <label class="flex items-center gap-2 text-sm text-gray-300">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published ?? false) ? 'checked' : '' }} class="accent-blue-600"> Publish now
    </label>
    <div class="flex gap-3 pt-4 border-t border-gray-700/50">
        <button class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium">Save Content</button>
        <a href="{{ route('admin.content.index') }}" class="px-6 py-2.5 bg-gray-700/50 text-gray-300 rounded-lg">Cancel</a>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>
    if (window.jQuery && jQuery.fn.summernote) {
        jQuery('#body-editor').summernote({ height: 260 });
    }
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css">
@endpush
