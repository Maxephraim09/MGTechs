<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('media_items', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('title')->nullable()->after('user_id');
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('type')->default('text')->after('slug');
            $table->text('summary')->nullable()->after('type');
            $table->longText('body')->nullable()->after('summary');
            $table->string('file_path')->nullable()->after('body');
            $table->string('file_name')->nullable()->after('file_path');
            $table->string('mime_type')->nullable()->after('file_name');
            $table->string('external_url')->nullable()->after('mime_type');
            $table->boolean('is_published')->default(false)->after('external_url');
            $table->unsignedBigInteger('views_count')->default(0)->after('is_published');
            $table->unsignedBigInteger('downloads_count')->default(0)->after('views_count');
            $table->timestamp('published_at')->nullable()->after('downloads_count');
        });
    }

    public function down(): void
    {
        Schema::table('media_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn([
                'title',
                'slug',
                'type',
                'summary',
                'body',
                'file_path',
                'file_name',
                'mime_type',
                'external_url',
                'is_published',
                'views_count',
                'downloads_count',
                'published_at',
            ]);
        });
    }
};
