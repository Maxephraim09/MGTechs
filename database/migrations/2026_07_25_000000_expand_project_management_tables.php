<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'project_code')) {
                $table->string('project_code')->nullable()->unique()->after('id');
            }
            if (! Schema::hasColumn('projects', 'admin_id')) {
                $table->foreignId('admin_id')->nullable()->after('client_id')->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('projects', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
            if (! Schema::hasColumn('projects', 'project_url')) {
                $table->string('project_url')->nullable()->after('image');
            }
            if (! Schema::hasColumn('projects', 'client_name')) {
                $table->string('client_name')->nullable()->after('project_url');
            }
            if (! Schema::hasColumn('projects', 'client_company')) {
                $table->string('client_company')->nullable()->after('client_name');
            }
            if (! Schema::hasColumn('projects', 'client_email')) {
                $table->string('client_email')->nullable()->after('client_company');
            }
            if (! Schema::hasColumn('projects', 'client_phone')) {
                $table->string('client_phone')->nullable()->after('client_email');
            }
            if (! Schema::hasColumn('projects', 'client_address')) {
                $table->text('client_address')->nullable()->after('client_phone');
            }
            if (! Schema::hasColumn('projects', 'project_amount')) {
                $table->decimal('project_amount', 15, 2)->default(0)->after('client_address');
            }
            if (! Schema::hasColumn('projects', 'amount_paid')) {
                $table->decimal('amount_paid', 15, 2)->default(0)->after('project_amount');
            }
            if (! Schema::hasColumn('projects', 'balance')) {
                $table->decimal('balance', 15, 2)->default(0)->after('amount_paid');
            }
            if (! Schema::hasColumn('projects', 'end_date')) {
                $table->date('end_date')->nullable()->after('deadline');
            }
            if (! Schema::hasColumn('projects', 'agreement_file')) {
                $table->string('agreement_file')->nullable()->after('milestones');
            }
            if (! Schema::hasColumn('projects', 'proposal_file')) {
                $table->string('proposal_file')->nullable()->after('agreement_file');
            }
        });

        Schema::table('project_updates', function (Blueprint $table) {
            if (! Schema::hasColumn('project_updates', 'project_id')) {
                $table->foreignId('project_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('project_updates', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('project_id')->constrained()->nullOnDelete();
            }
            if (! Schema::hasColumn('project_updates', 'content')) {
                $table->text('content')->nullable()->after('user_id');
            }
            if (! Schema::hasColumn('project_updates', 'admin_update')) {
                $table->text('admin_update')->nullable()->after('content');
            }
            if (! Schema::hasColumn('project_updates', 'client_feedback')) {
                $table->text('client_feedback')->nullable()->after('admin_update');
            }
            if (! Schema::hasColumn('project_updates', 'rating')) {
                $table->unsignedTinyInteger('rating')->nullable()->after('client_feedback');
            }
            if (! Schema::hasColumn('project_updates', 'status')) {
                $table->string('status')->nullable()->after('rating');
            }
            if (! Schema::hasColumn('project_updates', 'project_url')) {
                $table->string('project_url')->nullable()->after('status');
            }
        });

        Schema::table('project_files', function (Blueprint $table) {
            if (! Schema::hasColumn('project_files', 'project_id')) {
                $table->foreignId('project_id')->nullable()->after('id')->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('project_files', 'uploaded_by')) {
                $table->foreignId('uploaded_by')->nullable()->after('project_id')->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('project_files', 'filename')) {
                $table->string('filename')->nullable()->after('uploaded_by');
            }
            if (! Schema::hasColumn('project_files', 'path')) {
                $table->string('path')->nullable()->after('filename');
            }
            if (! Schema::hasColumn('project_files', 'mime_type')) {
                $table->string('mime_type')->nullable()->after('path');
            }
            if (! Schema::hasColumn('project_files', 'size')) {
                $table->unsignedBigInteger('size')->default(0)->after('mime_type');
            }
            if (! Schema::hasColumn('project_files', 'category')) {
                $table->string('category')->nullable()->after('size');
            }
        });
    }

    public function down(): void
    {
        Schema::table('project_files', function (Blueprint $table) {
            $table->dropColumn(['category', 'size', 'mime_type', 'path', 'filename']);
            $table->dropConstrainedForeignId('uploaded_by');
            $table->dropConstrainedForeignId('project_id');
        });

        Schema::table('project_updates', function (Blueprint $table) {
            $table->dropColumn(['project_url', 'status', 'rating', 'client_feedback', 'admin_update', 'content']);
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('project_id');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'proposal_file',
                'agreement_file',
                'end_date',
                'balance',
                'amount_paid',
                'project_amount',
                'client_address',
                'client_phone',
                'client_email',
                'client_company',
                'client_name',
                'project_url',
                'image',
                'project_code',
            ]);
            $table->dropConstrainedForeignId('admin_id');
        });
    }
};
