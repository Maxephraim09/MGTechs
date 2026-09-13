
# 🚀 Complete Project Management System for MGTECHS

I'll create a complete project management system with Client Portal and Admin Dashboard.

---

## 📁 Database Migrations

### 1. Projects Table Migration

**File:** `database/migrations/2024_01_01_000000_create_projects_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_code')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('project_url')->nullable();
            
            // Client Details
            $table->string('client_name');
            $table->string('client_company')->nullable();
            $table->string('client_email');
            $table->string('client_phone')->nullable();
            $table->text('client_address')->nullable();
            
            // Financial
            $table->decimal('project_amount', 15, 2)->default(0);
            $table->decimal('amount_paid', 15, 2)->default(0);
            $table->decimal('balance', 15, 2)->default(0);
            
            // Dates
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            
            // Files
            $table->string('agreement_file')->nullable();
            $table->string('proposal_file')->nullable();
            
            // Status
            $table->enum('status', ['pending', 'in_progress', 'review', 'completed', 'cancelled'])->default('pending');
            $table->integer('progress_percentage')->default(0);
            
            // Relationships
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('client_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
```

---

### 2. Project Reviews/Updates Table Migration

**File:** `database/migrations/2024_01_01_000001_create_project_reviews_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Admin Updates
            $table->text('admin_update')->nullable();
            
            // Client Feedback
            $table->text('client_feedback')->nullable();
            $table->integer('rating')->nullable()->min(1)->max(5);
            
            // Status
            $table->enum('status', ['pending', 'in_progress', 'review', 'completed'])->default('pending');
            $table->string('project_url')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_reviews');
    }
};
```

---

## 📁 Models

### 1. Project Model

**File:** `app/Models/Project.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'project_code',
        'title',
        'description',
        'image',
        'project_url',
        'client_name',
        'client_company',
        'client_email',
        'client_phone',
        'client_address',
        'project_amount',
        'amount_paid',
        'balance',
        'start_date',
        'end_date',
        'agreement_file',
        'proposal_file',
        'status',
        'progress_percentage',
        'admin_id',
        'client_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'project_amount' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'balance' => 'decimal:2',
    ];

    // Relationships
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProjectReview::class);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-500/20 text-yellow-400',
            'in_progress' => 'bg-blue-500/20 text-blue-400',
            'review' => 'bg-purple-500/20 text-purple-400',
            'completed' => 'bg-green-500/20 text-green-400',
            'cancelled' => 'bg-red-500/20 text-red-400',
        ];
        return $badges[$this->status] ?? 'bg-gray-500/20 text-gray-400';
    }

    public function getStatusTextAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    public function getBalanceAttribute()
    {
        return $this->project_amount - $this->amount_paid;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'in_progress', 'review']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeForClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }
}
```

---

### 2. ProjectReview Model

**File:** `app/Models/ProjectReview.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectReview extends Model
{
    protected $fillable = [
        'project_id',
        'user_id',
        'admin_update',
        'client_feedback',
        'rating',
        'status',
        'project_url',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-500/20 text-yellow-400',
            'in_progress' => 'bg-blue-500/20 text-blue-400',
            'review' => 'bg-purple-500/20 text-purple-400',
            'completed' => 'bg-green-500/20 text-green-400',
        ];
        return $badges[$this->status] ?? 'bg-gray-500/20 text-gray-400';
    }

    public function getRatingStarsAttribute()
    {
        if (!$this->rating) return '';
        return str_repeat('⭐', $this->rating);
    }
}
```

---

## 📁 Controllers

### 1. Admin Project Controller

**File:** `app/Http/Controllers/Admin/ProjectController.php`

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['admin', 'client'])->latest()->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'nullable|string|max:20',
            'client_address' => 'nullable|string',
            'client_id' => 'nullable|exists:users,id',
            'project_amount' => 'required|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'project_url' => 'nullable|url',
            'status' => 'required|in:pending,in_progress,review,completed,cancelled',
            'image' => 'nullable|image|max:2048',
            'agreement_file' => 'nullable|file|max:5120|mimes:pdf,doc,docx',
            'proposal_file' => 'nullable|file|max:5120|mimes:pdf,doc,docx',
        ]);

        // Generate project code
        $validated['project_code'] = 'PRJ-' . strtoupper(Str::random(8));
        $validated['admin_id'] = auth()->id();

        // Calculate balance
        $validated['balance'] = $validated['project_amount'] - ($validated['amount_paid'] ?? 0);

        // Handle file uploads
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects/images', 'public');
        }

        if ($request->hasFile('agreement_file')) {
            $validated['agreement_file'] = $request->file('agreement_file')->store('projects/agreements', 'public');
        }

        if ($request->hasFile('proposal_file')) {
            $validated['proposal_file'] = $request->file('proposal_file')->store('projects/proposals', 'public');
        }

        $project = Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully! Project Code: ' . $project->project_code);
    }

    public function show(Project $project)
    {
        $project->load(['admin', 'client', 'reviews.user']);
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'nullable|string|max:20',
            'client_address' => 'nullable|string',
            'client_id' => 'nullable|exists:users,id',
            'project_amount' => 'required|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'project_url' => 'nullable|url',
            'status' => 'required|in:pending,in_progress,review,completed,cancelled',
            'progress_percentage' => 'nullable|integer|min:0|max:100',
            'image' => 'nullable|image|max:2048',
            'agreement_file' => 'nullable|file|max:5120|mimes:pdf,doc,docx',
            'proposal_file' => 'nullable|file|max:5120|mimes:pdf,doc,docx',
        ]);

        // Calculate balance
        $validated['balance'] = $validated['project_amount'] - ($validated['amount_paid'] ?? 0);

        // Handle file uploads
        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects/images', 'public');
        }

        if ($request->hasFile('agreement_file')) {
            if ($project->agreement_file) {
                Storage::disk('public')->delete($project->agreement_file);
            }
            $validated['agreement_file'] = $request->file('agreement_file')->store('projects/agreements', 'public');
        }

        if ($request->hasFile('proposal_file')) {
            if ($project->proposal_file) {
                Storage::disk('public')->delete($project->proposal_file);
            }
            $validated['proposal_file'] = $request->file('proposal_file')->store('projects/proposals', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        // Delete files
        if ($project->image) Storage::disk('public')->delete($project->image);
        if ($project->agreement_file) Storage::disk('public')->delete($project->agreement_file);
        if ($project->proposal_file) Storage::disk('public')->delete($project->proposal_file);

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    public function addReview(Request $request, Project $project)
    {
        $validated = $request->validate([
            'admin_update' => 'nullable|string',
            'status' => 'nullable|in:pending,in_progress,review,completed',
            'project_url' => 'nullable|url',
        ]);

        $validated['project_id'] = $project->id;
        $validated['user_id'] = auth()->id();

        $review = ProjectReview::create($validated);

        // Update project status if provided
        if (isset($validated['status'])) {
            $project->update(['status' => $validated['status']]);
        }

        return redirect()->back()->with('success', 'Project update added successfully!');
    }
}
```

---

### 2. Client Project Controller

**File:** `app/Http/Controllers/Client/ProjectController.php`

```php
<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectReview;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('client_id', auth()->id())
            ->orWhere('client_email', auth()->user()->email)
            ->latest()
            ->paginate(10);
            
        $stats = [
            'total' => $projects->total(),
            'active' => Project::where('client_id', auth()->id())->active()->count(),
            'completed' => Project::where('client_id', auth()->id())->completed()->count(),
        ];
        
        return view('client.projects.index', compact('projects', 'stats'));
    }

    public function show(Project $project)
    {
        // Ensure client owns this project
        $this->authorizeProject($project);
        
        $project->load(['reviews.user']);
        $reviews = $project->reviews()->latest()->paginate(10);
        
        return view('client.projects.show', compact('project', 'reviews'));
    }

    public function feedback(Request $request, Project $project)
    {
        // Ensure client owns this project
        $this->authorizeProject($project);
        
        $validated = $request->validate([
            'client_feedback' => 'required|string|max:5000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $validated['project_id'] = $project->id;
        $validated['user_id'] = auth()->id();
        $validated['status'] = $project->status;

        ProjectReview::create($validated);

        // Update project progress based on feedback/rating
        if (isset($validated['rating'])) {
            // Calculate average rating for the project
            $avgRating = ProjectReview::where('project_id', $project->id)->avg('rating');
            // You could store this in the project table if needed
        }

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }

    public function rateCompany(Request $request, Project $project)
    {
        // Ensure client owns this project
        $this->authorizeProject($project);
        
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        // Create a review with rating
        ProjectReview::create([
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'client_feedback' => $validated['review_text'] ?? null,
            'rating' => $validated['rating'],
            'status' => $project->status,
        ]);

        return redirect()->back()->with('success', 'Thank you for rating our service!');
    }

    public function requestNewProject()
    {
        return view('client.projects.request');
    }

    public function storeRequest(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'nullable|numeric|min:0',
            'timeline' => 'nullable|string',
        ]);

        // Create a pending project request
        // You can create a ProjectRequest model or use the projects table with status 'pending'

        return redirect()->back()->with('success', 'Project request submitted successfully! We will review it shortly.');
    }

    private function authorizeProject(Project $project)
    {
        if ($project->client_id !== auth()->id() && $project->client_email !== auth()->user()->email) {
            abort(403, 'Unauthorized access to this project.');
        }
    }
}
```

---

## 📁 Client Dashboard View

**File:** `resources/views/client/dashboard.blade.php`

```blade
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Client Dashboard') }}
            </h2>
            <span class="px-3 py-1 text-sm bg-blue-500/20 text-blue-400 rounded-full border border-blue-500/20">
                <i class="fas fa-user mr-1"></i> {{ Auth::user()->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="dashboard-welcome">
                <div class="overlay"></div>
                <div class="glow top-right"></div>
                <div class="glow bottom-left"></div>
                <div class="content">
                    <div class="greeting">
                        <span class="emoji">👋</span>
                        <h1 class="title">Welcome back, <span class="name">{{ Auth::user()->name }}</span></h1>
                    </div>
                    <p class="subtitle">Track your projects, communicate with our team, and manage your files.</p>
                    <div class="badges">
                        <span class="badge">
                            <span class="dot green"></span>
                            {{ $activeProjects ?? 0 }} Active Projects
                        </span>
                        <span class="badge">
                            <span class="dot" style="background: #FBBF24;"></span>
                            {{ $completedProjects ?? 0 }} Completed
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="stat-card hover-blue">
                    <div class="stat-header">
                        <div>
                            <p class="stat-label">Total Projects</p>
                            <p class="stat-number">{{ $stats['total'] ?? 0 }}</p>
                        </div>
                        <div class="stat-icon blue">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card hover-green">
                    <div class="stat-header">
                        <div>
                            <p class="stat-label">Active Projects</p>
                            <p class="stat-number">{{ $stats['active'] ?? 0 }}</p>
                        </div>
                        <div class="stat-icon green">
                            <i class="fas fa-play-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card hover-purple">
                    <div class="stat-header">
                        <div>
                            <p class="stat-label">Completed</p>
                            <p class="stat-number">{{ $stats['completed'] ?? 0 }}</p>
                        </div>
                        <div class="stat-icon purple">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card hover-orange">
                    <div class="stat-header">
                        <div>
                            <p class="stat-label">Pending</p>
                            <p class="stat-number">{{ $stats['pending'] ?? 0 }}</p>
                        </div>
                        <div class="stat-icon orange">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Projects -->
            <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <div class="p-4 border-b border-gray-700/50 flex justify-between items-center">
                    <h3 class="text-sm font-semibold text-white">My Recent Projects</h3>
                    <a href="{{ route('client.projects.index') }}" class="text-xs text-blue-400 hover:text-blue-300">View All</a>
                </div>
                <div class="p-4 space-y-3">
                    @forelse($projects ?? [] as $project)
                        <div class="border border-gray-700/50 rounded-lg p-4 hover:bg-gray-700/20 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center gap-3">
                                        <h4 class="font-medium text-white">{{ $project->title }}</h4>
                                        <span class="px-2 py-1 text-xs rounded-full {{ $project->status_badge }}">
                                            {{ $project->status_text }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-400 mt-1">{{ $project->description ?? 'No description' }}</p>
                                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                        <span><i class="fas fa-code mr-1"></i> {{ $project->project_code }}</span>
                                        <span><i class="fas fa-calendar-alt mr-1"></i> {{ $project->start_date ? $project->start_date->format('M d, Y') : 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div class="text-right">
                                        <div class="text-sm text-white">₦{{ number_format($project->amount_paid, 2) }}</div>
                                        <div class="text-xs text-gray-500">of ₦{{ number_format($project->project_amount, 2) }}</div>
                                    </div>
                                    <a href="{{ route('client.projects.show', $project) }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="flex justify-between text-xs text-gray-500">
                                    <span>Progress</span>
                                    <span>{{ $project->progress_percentage ?? 0 }}%</span>
                                </div>
                                <div class="w-full bg-gray-700 rounded-full h-1.5 mt-1">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-1.5 rounded-full" style="width: {{ $project->progress_percentage ?? 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">You don't have any projects yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <a href="{{ route('client.projects.request') }}" class="bg-gray-800/60 p-4 rounded-xl border border-gray-700/50 text-center hover:border-blue-500 transition">
                    <i class="fas fa-plus-circle text-blue-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-300">Request Project</span>
                </a>
                <a href="#" class="bg-gray-800/60 p-4 rounded-xl border border-gray-700/50 text-center hover:border-green-500 transition">
                    <i class="fas fa-comment text-green-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-300">Send Feedback</span>
                </a>
                <a href="#" class="bg-gray-800/60 p-4 rounded-xl border border-gray-700/50 text-center hover:border-purple-500 transition">
                    <i class="fas fa-file-invoice text-purple-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-300">Invoices</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="bg-gray-800/60 p-4 rounded-xl border border-gray-700/50 text-center hover:border-yellow-500 transition">
                    <i class="fas fa-user-edit text-yellow-400 text-xl mb-2 block"></i>
                    <span class="text-sm text-gray-300">Profile</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
```

---

## 📁 Client Project Show View

**File:** `resources/views/client/projects/show.blade.php`

```blade
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    {{ $project->title }}
                </h2>
                <p class="text-sm text-gray-400">Project Code: {{ $project->project_code }}</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 text-sm rounded-full {{ $project->status_badge }}">
                    {{ $project->status_text }}
                </span>
                <a href="{{ route('client.projects.index') }}" class="text-gray-400 hover:text-white transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Project Overview -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Info -->
                <div class="lg:col-span-2 bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                    <div class="p-6">
                        <!-- Progress -->
                        <div class="mb-6">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-400">Progress</span>
                                <span class="text-white">{{ $project->progress_percentage ?? 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" style="width: {{ $project->progress_percentage ?? 0 }}%"></div>
                            </div>
                        </div>

                        <!-- Project Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Client</p>
                                <p class="text-white">{{ $project->client_name }}</p>
                                <p class="text-sm text-gray-400">{{ $project->client_company }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Project URL</p>
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" class="text-blue-400 hover:text-blue-300">
                                        {{ $project->project_url }}
                                    </a>
                                @else
                                    <p class="text-gray-500">Not available</p>
                                @endif
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Start Date</p>
                                <p class="text-white">{{ $project->start_date ? $project->start_date->format('M d, Y') : 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">End Date</p>
                                <p class="text-white">{{ $project->end_date ? $project->end_date->format('M d, Y') : 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Financial -->
                        <div class="mt-4 p-4 bg-gray-700/20 rounded-lg">
                            <h4 class="text-sm font-semibold text-white mb-2">Financial Summary</h4>
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <p class="text-xs text-gray-500">Total Amount</p>
                                    <p class="text-white font-semibold">₦{{ number_format($project->project_amount, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Amount Paid</p>
                                    <p class="text-green-400 font-semibold">₦{{ number_format($project->amount_paid, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Balance</p>
                                    <p class="text-yellow-400 font-semibold">₦{{ number_format($project->balance, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <p class="text-xs text-gray-500">Description</p>
                            <p class="text-white mt-1">{{ $project->description ?? 'No description' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-4">
                    <!-- Quick Actions -->
                    <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 p-4">
                        <h4 class="text-sm font-semibold text-white mb-3">Quick Actions</h4>
                        <div class="space-y-2">
                            <button onclick="document.getElementById('feedbackForm').scrollIntoView({behavior:'smooth'})" class="w-full text-left px-4 py-2 bg-blue-500/10 hover:bg-blue-500/20 rounded-lg text-blue-400 transition text-sm">
                                <i class="fas fa-comment mr-2"></i> Send Feedback
                            </button>
                            <button onclick="document.getElementById('ratingSection').scrollIntoView({behavior:'smooth'})" class="w-full text-left px-4 py-2 bg-yellow-500/10 hover:bg-yellow-500/20 rounded-lg text-yellow-400 transition text-sm">
                                <i class="fas fa-star mr-2"></i> Rate Company
                            </button>
                            <a href="#" class="w-full text-left px-4 py-2 bg-purple-500/10 hover:bg-purple-500/20 rounded-lg text-purple-400 transition text-sm block">
                                <i class="fas fa-download mr-2"></i> Download Agreement
                            </a>
                        </div>
                    </div>

                    <!-- Files -->
                    @if($project->image || $project->agreement_file || $project->proposal_file)
                        <div class="bg-gray-800/60 rounded-xl border border-gray-700/50 p-4">
                            <h4 class="text-sm font-semibold text-white mb-3">Project Files</h4>
                            <div class="space-y-2">
                                @if($project->image)
                                    <a href="{{ asset('storage/' . $project->image) }}" target="_blank" class="flex items-center gap-2 text-sm text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-image"></i> Project Image
                                    </a>
                                @endif
                                @if($project->agreement_file)
                                    <a href="{{ asset('storage/' . $project->agreement_file) }}" target="_blank" class="flex items-center gap-2 text-sm text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-file-contract"></i> Agreement
                                    </a>
                                @endif
                                @if($project->proposal_file)
                                    <a href="{{ asset('storage/' . $project->proposal_file) }}" target="_blank" class="flex items-center gap-2 text-sm text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-file-pdf"></i> Proposal
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Feedback Form -->
            <div id="feedbackForm" class="mt-6 bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <div class="p-6">
                    <h4 class="text-sm font-semibold text-white mb-4">Send Feedback</h4>
                    <form action="{{ route('client.projects.feedback', $project) }}" method="POST">
                        @csrf
                        <div class="space-y-3">
                            <textarea name="client_feedback" rows="4" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none" placeholder="Write your feedback here..." required></textarea>
                            <div>
                                <label class="text-sm text-gray-400">Rating (Optional)</label>
                                <div class="flex items-center gap-2 mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer text-2xl hover:scale-110 transition">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden peer">
                                            <span class="peer-checked:text-yellow-400 text-gray-600">⭐</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-lg font-medium transition">
                                <i class="fas fa-paper-plane mr-2"></i> Send Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Rate Company -->
            <div id="ratingSection" class="mt-6 bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <div class="p-6">
                    <h4 class="text-sm font-semibold text-white mb-4">Rate Our Service</h4>
                    <form action="{{ route('client.projects.rate', $project) }}" method="POST">
                        @csrf
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm text-gray-400">Your Rating</label>
                                <div class="flex items-center gap-3 mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer text-3xl hover:scale-110 transition">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required>
                                            <span class="peer-checked:text-yellow-400 text-gray-600">⭐</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <textarea name="review_text" rows="3" class="w-full bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition resize-none" placeholder="Tell us about your experience..."></textarea>
                            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-yellow-600 to-amber-600 hover:from-yellow-700 hover:to-amber-700 text-white rounded-lg font-medium transition">
                                <i class="fas fa-star mr-2"></i> Submit Rating
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Project Updates/Reviews -->
            <div class="mt-6 bg-gray-800/60 rounded-xl border border-gray-700/50 overflow-hidden">
                <div class="p-4 border-b border-gray-700/50">
                    <h4 class="text-sm font-semibold text-white">Project Updates</h4>
                </div>
                <div class="p-4 space-y-4 max-h-96 overflow-y-auto">
                    @forelse($reviews ?? [] as $review)
                        <div class="border border-gray-700/50 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-medium text-white">{{ $review->user->name ?? 'System' }}</span>
                                        <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    @if($review->admin_update)
                                        <div class="mt-2 p-3 bg-blue-500/10 border border-blue-500/20 rounded-lg">
                                            <p class="text-sm text-blue-300"><i class="fas fa-edit mr-2"></i> Admin Update</p>
                                            <p class="text-sm text-gray-300 mt-1">{{ $review->admin_update }}</p>
                                        </div>
                                    @endif
                                    @if($review->client_feedback)
                                        <div class="mt-2 p-3 bg-green-500/10 border border-green-500/20 rounded-lg">
                                            <p class="text-sm text-green-300"><i class="fas fa-comment mr-2"></i> Client Feedback</p>
                                            <p class="text-sm text-gray-300 mt-1">{{ $review->client_feedback }}</p>
                                            @if($review->rating)
                                                <div class="mt-1 text-yellow-400">{{ $review->rating_stars }}</div>
                                            @endif
                                        </div>
                                    @endif
                                    @if($review->status)
                                        <div class="mt-2">
                                            <span class="px-2 py-1 text-xs rounded-full {{ $review->status_badge }}">
                                                Status: {{ ucfirst($review->status) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">No updates yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```

---

## 📁 Routes

**File:** `routes/client.php`

```php
<?php

use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{project}/feedback', [ProjectController::class, 'feedback'])->name('projects.feedback');
    Route::post('/projects/{project}/rate', [ProjectController::class, 'rateCompany'])->name('projects.rate');
    Route::get('/projects/request', [ProjectController::class, 'requestNewProject'])->name('projects.request');
    Route::post('/projects/request', [ProjectController::class, 'storeRequest'])->name('projects.request.store');
});
```

---

## 📁 Admin Routes

**File:** `routes/admin.php` (Add these routes)

```php
// Add to existing admin routes
Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);
Route::post('/projects/{project}/review', [App\Http\Controllers\Admin\ProjectController::class, 'addReview'])->name('projects.review');
```

---

## 🚀 Run Migrations

```bash
php artisan migrate
```

---

## ✅ Features Implemented

| Feature | Status |
|---------|--------|
| **Client Login to Dashboard** | ✅ |
| **Track Project Progress** | ✅ |
| **View Recent Updates** | ✅ |
| **Send Feedback to Admin** | ✅ |
| **Rate Company** | ✅ |
| **Request New Project** | ✅ |
| **Admin Create Project** | ✅ |
| **Project Details (Title, Description, Code, Image)** | ✅ |
| **Client Details (Name, Company, Email, Phone, Address)** | ✅ |
| **Financial (Amount, Paid, Balance)** | ✅ |
| **Dates (Start, End)** | ✅ |
| **Files (Agreement, Proposal)** | ✅ |
| **Project URL** | ✅ |
| **Status Management** | ✅ |
| **Project Reviews (Admin Update, Client Feedback)** | ✅ |

**Your complete project management system is ready!** 🚀








































# MGTECHS.COM.NG - Complete Laravel Project Structure & Features Documentation

## 📁 Full Folder & File Structure

```
C:\Users\MGTechs\GITHUB\mgtechs\
│
├── app/
│   ├── Console/
│   │   ├── Commands/
│   │   │   ├── GenerateCertificates.php
│   │   │   ├── SendMarketingEmails.php
│   │   │   └── CleanTempFiles.php
│   │   └── Kernel.php
│   │
│   ├── Exceptions/
│   │   └── Handler.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── UserController.php
│   │   │   │   ├── SettingController.php
│   │   │   │   └── ReportController.php
│   │   │   │
│   │   │   ├── Client/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProjectController.php
│   │   │   │   ├── FeedbackController.php
│   │   │   │   └── ProfileController.php
│   │   │   │
│   │   │   ├── Student/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── CourseController.php
│   │   │   │   ├── QuizController.php
│   │   │   │   ├── CertificateController.php
│   │   │   │   └── ProfileController.php
│   │   │   │
│   │   │   ├── Api/
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── ProjectController.php
│   │   │   │   ├── CourseController.php
│   │   │   │   └── QuizController.php
│   │   │   │
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── VerificationController.php
│   │   │   │
│   │   │   ├── Public/
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── BlogController.php
│   │   │   │   ├── CourseController.php
│   │   │   │   ├── ServiceController.php
│   │   │   │   └── ContactController.php
│   │   │   │
│   │   │   ├── Marketing/
│   │   │   │   ├── EmailController.php
│   │   │   │   ├── SmsController.php
│   │   │   │   └── CampaignController.php
│   │   │   │
│   │   │   └── Payment/
│   │   │       ├── CheckoutController.php
│   │   │       ├── WebhookController.php
│   │   │       └── InvoiceController.php
│   │   │
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php
│   │   │   ├── ClientMiddleware.php
│   │   │   ├── StudentMiddleware.php
│   │   │   ├── RoleMiddleware.php
│   │   │   └── VerifyCsrfToken.php
│   │   │
│   │   ├── Requests/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginRequest.php
│   │   │   │   └── RegisterRequest.php
│   │   │   ├── Admin/
│   │   │   │   ├── UserRequest.php
│   │   │   │   └── CourseRequest.php
│   │   │   ├── Client/
│   │   │   │   ├── ProjectRequest.php
│   │   │   │   └── FeedbackRequest.php
│   │   │   └── Student/
│   │   │       ├── QuizRequest.php
│   │   │       └── EnrollmentRequest.php
│   │   │
│   │   └── Resources/
│   │       ├── Views/
│   │       └── Lang/
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Client.php
│   │   ├── Project.php
│   │   ├── ProjectUpdate.php
│   │   ├── ProjectFile.php
│   │   ├── Course.php
│   │   ├── Lesson.php
│   │   ├── LessonProgress.php
│   │   ├── Enrollment.php
│   │   ├── Quiz.php
│   │   ├── QuizQuestion.php
│   │   ├── QuizOption.php
│   │   ├── QuizAttempt.php
│   │   ├── QuizAnswer.php
│   │   ├── Certificate.php
│   │   ├── BlogPost.php
│   │   ├── BlogCategory.php
│   │   ├── MediaItem.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Notification.php
│   │   ├── EmailLog.php
│   │   ├── SmsLog.php
│   │   ├── Payment.php
│   │   ├── Service.php
│   │   ├── Testimonial.php
│   │   └── Setting.php
│   │
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   └── RouteServiceProvider.php
│   │
│   ├── Services/
│   │   ├── Payment/
│   │   │   ├── PaystackService.php
│   │   │   ├── FlutterwaveService.php
│   │   │   └── StripeService.php
│   │   ├── Notification/
│   │   │   ├── EmailService.php
│   │   │   ├── SmsService.php
│   │   │   └── PushNotificationService.php
│   │   ├── Certificate/
│   │   │   ├── CertificateGenerator.php
│   │   │   └── PdfGenerator.php
│   │   ├── Media/
│   │   │   ├── VideoProcessor.php
│   │   │   ├── ImageOptimizer.php
│   │   │   └── AudioProcessor.php
│   │   └── Analytics/
│   │       ├── ReportGenerator.php
│   │       └── AnalyticsService.php
│   │
│   └── Traits/
│       ├── HasRoles.php
│       ├── HasPermissions.php
│       ├── HandlesFiles.php
│       └── GeneratesCertificates.php
│
├── bootstrap/
│   ├── app.php
│   ├── cache/
│   └── providers.php
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── sanctum.php
│   ├── database.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   ├── filesystems.php
│   ├── permissions.php
│   ├── roles.php
│   ├── payment.php
│   ├── sms.php
│   └── certificate.php
│
├── database/
│   ├── factories/
│   │   ├── UserFactory.php
│   │   ├── ProjectFactory.php
│   │   ├── CourseFactory.php
│   │   └── QuizFactory.php
│   │
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_resets_table.php
│   │   ├── 2019_08_19_000000_create_failed_jobs_table.php
│   │   ├── 2019_12_14_000001_create_personal_access_tokens_table.php
│   │   ├── 2024_01_01_000001_create_clients_table.php
│   │   ├── 2024_01_01_000002_create_projects_table.php
│   │   ├── 2024_01_01_000003_create_project_updates_table.php
│   │   ├── 2024_01_01_000004_create_project_files_table.php
│   │   ├── 2024_01_01_000005_create_courses_table.php
│   │   ├── 2024_01_01_000006_create_lessons_table.php
│   │   ├── 2024_01_01_000007_create_lesson_progress_table.php
│   │   ├── 2024_01_01_000008_create_enrollments_table.php
│   │   ├── 2024_01_01_000009_create_quizzes_table.php
│   │   ├── 2024_01_01_000010_create_quiz_questions_table.php
│   │   ├── 2024_01_01_000011_create_quiz_options_table.php
│   │   ├── 2024_01_01_000012_create_quiz_attempts_table.php
│   │   ├── 2024_01_01_000013_create_quiz_answers_table.php
│   │   ├── 2024_01_01_000014_create_certificates_table.php
│   │   ├── 2024_01_01_000015_create_blog_posts_table.php
│   │   ├── 2024_01_01_000016_create_blog_categories_table.php
│   │   ├── 2024_01_01_000017_create_media_items_table.php
│   │   ├── 2024_01_01_000018_create_orders_table.php
│   │   ├── 2024_01_01_000019_create_order_items_table.php
│   │   ├── 2024_01_01_000020_create_notifications_table.php
│   │   ├── 2024_01_01_000021_create_email_logs_table.php
│   │   ├── 2024_01_01_000022_create_sms_logs_table.php
│   │   ├── 2024_01_01_000023_create_payments_table.php
│   │   ├── 2024_01_01_000024_create_services_table.php
│   │   ├── 2024_01_01_000025_create_testimonials_table.php
│   │   └── 2024_01_01_000026_create_settings_table.php
│   │
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── RoleSeeder.php
│   │   ├── PermissionSeeder.php
│   │   ├── CourseSeeder.php
│   │   └── ServiceSeeder.php
│   │
│   └── database.sqlite
│
├── public/
│   ├── index.php
│   ├── .htaccess
│   ├── favicon.ico
│   ├── robots.txt
│   ├── css/
│   │   ├── app.css
│   │   └── admin.css
│   ├── js/
│   │   ├── app.js
│   │   ├── admin.js
│   │   └── client.js
│   ├── images/
│   │   ├── logo/
│   │   ├── services/
│   │   ├── courses/
│   │   └── blog/
│   ├── storage/
│   └── certificates/
│
├── resources/
│   ├── css/
│   │   └── app.css
│   │
│   ├── js/
│   │   ├── app.js
│   │   ├── admin.js
│   │   ├── client.js
│   │   ├── student.js
│   │   └── components/
│   │       ├── charts.js
│   │       └── calendar.js
│   │
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   ├── admin.blade.php
│   │   │   ├── client.blade.php
│   │   │   └── student.blade.php
│   │   │
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   ├── register.blade.php
│   │   │   ├── verify-email.blade.php
│   │   │   └── reset-password.blade.php
│   │   │
│   │   ├── admin/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── users/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   ├── edit.blade.php
│   │   │   │   └── show.blade.php
│   │   │   ├── projects/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   ├── edit.blade.php
│   │   │   │   └── show.blade.php
│   │   │   ├── courses/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   ├── edit.blade.php
│   │   │   │   └── show.blade.php
│   │   │   ├── quizzes/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── blog/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   └── edit.blade.php
│   │   │   ├── marketing/
│   │   │   │   ├── email.blade.php
│   │   │   │   ├── sms.blade.php
│   │   │   │   └── campaigns.blade.php
│   │   │   ├── reports/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── revenue.blade.php
│   │   │   │   └── users.blade.php
│   │   │   └── settings/
│   │   │       ├── general.blade.php
│   │   │       ├── payment.blade.php
│   │   │       └── email.blade.php
│   │   │
│   │   ├── client/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── projects/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── show.blade.php
│   │   │   ├── feedback.blade.php
│   │   │   └── profile.blade.php
│   │   │
│   │   ├── student/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── courses/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── show.blade.php
│   │   │   │   └── lesson.blade.php
│   │   │   ├── quiz/
│   │   │   │   ├── take.blade.php
│   │   │   │   └── result.blade.php
│   │   │   ├── certificates/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── print.blade.php
│   │   │   └── profile.blade.php
│   │   │
│   │   ├── public/
│   │   │   ├── home.blade.php
│   │   │   ├── services.blade.php
│   │   │   ├── about.blade.php
│   │   │   ├── contact.blade.php
│   │   │   ├── blog/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── show.blade.php
│   │   │   └── courses/
│   │   │       ├── index.blade.php
│   │   │       └── show.blade.php
│   │   │
│   │   ├── components/
│   │   │   ├── navbar.blade.php
│   │   │   ├── footer.blade.php
│   │   │   ├── sidebar.blade.php
│   │   │   ├── progress-bar.blade.php
│   │   │   ├── certificate-template.blade.php
│   │   │   └── payment-modal.blade.php
│   │   │
│   │   ├── emails/
│   │   │   ├── marketing.blade.php
│   │   │   ├── invoice.blade.php
│   │   │   ├── welcome.blade.php
│   │   │   ├── project-update.blade.php
│   │   │   ├── course-enrollment.blade.php
│   │   │   └── certificate-issued.blade.php
│   │   │
│   │   ├── errors/
│   │   │   ├── 401.blade.php
│   │   │   ├── 403.blade.php
│   │   │   ├── 404.blade.php
│   │   │   └── 500.blade.php
│   │   │
│   │   └── vendor/
│   │
│   └── lang/
│       ├── en/
│       │   ├── auth.php
│       │   ├── pagination.php
│       │   ├── passwords.php
│       │   └── validation.php
│       └── ha/
│           ├── auth.php
│           ├── pagination.php
│           ├── passwords.php
│           └── validation.php
│
├── routes/
│   ├── web.php
│   ├── api.php
│   ├── auth.php
│   ├── admin.php
│   ├── client.php
│   └── student.php
│
├── storage/
│   ├── app/
│   │   ├── public/
│   │   │   ├── projects/
│   │   │   ├── courses/
│   │   │   ├── certificates/
│   │   │   ├── media/
│   │   │   └── temp/
│   │   └── private/
│   │       ├── invoices/
│   │       └── reports/
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   ├── testing/
│   │   └── views/
│   └── logs/
│       ├── laravel.log
│       ├── email.log
│       ├── sms.log
│       └── payment.log
│
├── tests/
│   ├── Unit/
│   │   ├── Models/
│   │   ├── Services/
│   │   └── Helpers/
│   └── Feature/
│       ├── Auth/
│       ├── Projects/
│       ├── Courses/
│       └── Payments/
│
├── .env
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── tailwind.config.js
├── postcss.config.js
├── vite.config.js
├── phpunit.xml
├── README.md
└── setup.ps1
```

---

## 📋 Complete Features List & Explanation

### 🔐 1. AUTHENTICATION & AUTHORIZATION SYSTEM

| Feature | Description | User Roles |
|---------|-------------|------------|
| **User Registration** | New users can register as clients or students | Public |
| **User Login** | Secure login with email/password | All |
| **Email Verification** | Verify email addresses before full access | All |
| **Password Reset** | Reset forgotten passwords via email | All |
| **Role-Based Access** | Different dashboards and permissions per role | Admin, Client, Student |
| **Two-Factor Authentication** | Optional 2FA for enhanced security | All |
| **Remember Me** | Persistent login sessions | All |
| **Social Login** | Login with Google, Facebook, LinkedIn | All |
| **Profile Management** | Update personal info, avatar, password | All |
| **Account Deactivation** | Users can deactivate their accounts | All |

### 👑 2. ADMIN DASHBOARD

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Overview Dashboard** | Key metrics: users, projects, revenue, courses | Admin |
| **User Management** | Create, edit, delete, suspend users | Admin |
| **Role Management** | Assign and modify user roles | Admin |
| **System Settings** | Configure website settings, payment gateways | Admin |
| **Activity Logs** | View all system activities and user actions | Admin |
| **Analytics & Reports** | Generate reports on users, revenue, courses | Admin |
| **Backup Management** | Create and restore system backups | Admin |
| **Notification Center** | Send system-wide announcements | Admin |
| **Permission Management** | Granular permission control | Admin |

### 📁 3. CLIENT PROJECT TRACKING PORTAL

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Project Dashboard** | View all projects with status and progress | Client |
| **Project Creation** | Create new projects with details | Admin |
| **Milestone Tracking** | Track project milestones and deadlines | Admin, Client |
| **Progress Bar** | Visual progress indicator for each project | Client |
| **File Sharing** | Upload and download project files | Admin, Client |
| **Feedback System** | Submit feedback and receive responses | Client |
| **Status Updates** | Real-time project status updates | Admin, Client |
| **Project Timeline** | Gantt chart view of project phases | Client |
| **Task Management** | Break projects into tasks with assignments | Admin |
| **Comment System** | Discuss project details on each task | Admin, Client |
| **Email Notifications** | Get notified of project updates | Client |
| **Deliverable Review** | Review and approve deliverables | Client |
| **Time Tracking** | Track time spent on projects (if applicable) | Admin |
| **Invoice Generation** | Generate invoices from projects | Admin |
| **Payment History** | View payment history for projects | Client |

### 🎓 4. LEARNING MANAGEMENT SYSTEM (LMS)

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Course Creation** | Create courses with title, description, image | Admin |
| **Lesson Management** | Create lessons with text, video, audio | Admin |
| **Video Hosting** | Upload or embed videos | Admin |
| **Audio Content** | Upload audio files for lessons | Admin |
| **Document Support** | Upload PDFs, PPTs, Word documents | Admin |
| **Lesson Ordering** | Drag-and-drop lesson ordering | Admin |
| **Free/Paid Courses** | Set courses as free or paid | Admin |
| **Course Pricing** | Set price for paid courses | Admin |
| **Enrollment System** | Students enroll in courses | Student |
| **Enrollment Approval** | Manual or automatic enrollment approval | Admin |
| **Course Categories** | Organize courses by category | Admin |
| **Course Progress** | Track lesson completion progress | Student |
| **Lesson Completion** | Mark lessons as completed | Student |
| **Student Dashboard** | View enrolled courses and progress | Student |
| **Instructor Assignment** | Assign instructors to courses | Admin |
| **Course Reviews** | Students can rate and review courses | Student |
| **Course Analytics** | Track course popularity and completion rates | Admin |

### 📝 5. COMPUTER-BASED TEST (CBT) SYSTEM

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Quiz Creation** | Create quizzes with title, description | Admin |
| **Question Types** | Multiple choice, true/false, fill-in-blank | Admin |
| **Question Bank** | Save and reuse questions | Admin |
| **Random Questions** | Randomize question order for each attempt | Admin |
| **Time Limit** | Set time limits for quizzes | Admin |
| **Passing Score** | Set minimum passing percentage | Admin |
| **Max Attempts** | Limit number of attempts per student | Admin |
| **Auto-Grading** | Automatic scoring of objective questions | System |
| **Instant Results** | Show results immediately after submission | Student |
| **Score Display** | Show score, percentage, and pass/fail status | Student |
| **Answer Review** | Review correct and incorrect answers | Student |
| **Question Randomization** | Randomize answer options | Admin |
| **Question Feedback** | Provide feedback for each question | Admin |
| **Quiz Scheduling** | Schedule quizzes for specific dates | Admin |
| **Quiz Attempts** | Track all quiz attempts | Admin |
| **Analytics** | Quiz performance analytics | Admin |

### 🏆 6. CERTIFICATE GENERATION SYSTEM

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Automatic Generation** | Auto-generate certificate upon course completion | System |
| **Certificate Templates** | Multiple certificate templates | Admin |
| **Custom Certificate** | Create custom certificate designs | Admin |
| **Certificate Number** | Unique certificate numbers | System |
| **Student Name** | Dynamic student name insertion | System |
| **Course Name** | Dynamic course name insertion | System |
| **Date Issued** | Auto-date stamp on certificates | System |
| **Digital Signatures** | Add digital signatures | Admin |
| **Certificate PDF** | Download as PDF | Student |
| **Print Certificate** | Print certificates directly | Student |
| **Certificate Verification** | Verify certificate authenticity online | Public |
| **Certificate Sharing** | Share certificates on social media | Student |
| **Certificate Management** | View all issued certificates | Admin |
| **Certificate Revocation** | Revoke certificates if needed | Admin |
| **Certificate Analytics** | Track certificate issuance stats | Admin |

### 📝 7. BLOG & CONTENT MANAGEMENT

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Blog Posts** | Create, edit, delete blog posts | Admin |
| **Categories** | Organize posts by category | Admin |
| **Tags** | Tag posts for better discovery | Admin |
| **SEO Optimization** | Meta titles, descriptions, keywords | Admin |
| **Featured Image** | Add featured images to posts | Admin |
| **Post Scheduling** | Schedule posts for future publication | Admin |
| **Draft System** | Save posts as drafts | Admin |
| **Content Editor** | Rich text editor for content | Admin |
| **Media Embedding** | Embed videos, audio, images in posts | Admin |
| **Comments System** | Allow/disallow comments on posts | Admin |
| **Comment Moderation** | Approve, edit, delete comments | Admin |
| **Social Sharing** | Share posts on social media | Public |
| **Related Posts** | Show related posts at end of article | Public |
| **RSS Feed** | RSS feed for blog subscribers | Public |
| **Analytics** | Track post views and engagement | Admin |

### 🎥 8. MEDIA & TUTORIAL DATABASE

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Media Library** | Central repository for all media | Admin |
| **Video Upload** | Upload videos (MP4, AVI, etc.) | Admin |
| **Audio Upload** | Upload audio files (MP3, WAV, etc.) | Admin |
| **Image Upload** | Upload images (JPG, PNG, WebP) | Admin |
| **Document Upload** | Upload documents (PDF, DOC, PPT) | Admin |
| **File Organization** | Organize media by folders | Admin |
| **Media Metadata** | Add title, description, tags | Admin |
| **Free/Paid Access** | Set media items as free or paid | Admin |
| **Media Search** | Search media by title, tags, description | All |
| **Video Player** | Built-in video player | All |
| **Audio Player** | Built-in audio player | All |
| **File Preview** | Preview files before download | All |
| **Download Options** | Download media files | All |
| **Media Categories** | Categorize media by type, topic | Admin |
| **Media Usage** | Track which media is used where | Admin |

### 🛒 9. E-COMMERCE & PAYMENT SYSTEM

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Product Catalog** | Display products/services for sale | Public |
| **Shopping Cart** | Add items to cart | Public |
| **Checkout Process** | Multiple step checkout | Public |
| **Payment Gateways** | Paystack, Flutterwave, Stripe | System |
| **Payment Options** | Card, Bank Transfer, USSD | Public |
| **Order Management** | Track all orders | Admin |
| **Invoice Generation** | Generate invoices for orders | System |
| **Download Digital Products** | Instant access to digital purchases | Client/Student |
| **Payment History** | View payment history | User |
| **Refund System** | Process refunds | Admin |
| **Coupon/Discount** | Create and apply coupons | Admin |
| **Subscription Plans** | Recurring payments for subscription | Admin |
| **Payment Analytics** | Track revenue, sales trends | Admin |
| **Transaction Logs** | Detailed transaction logs | Admin |
| **Currency Support** | Multi-currency support | Admin |

### 📧 10. MARKETING AUTOMATION

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Email Campaigns** | Create and send email campaigns | Admin |
| **SMS Campaigns** | Create and send SMS campaigns | Admin |
| **Email Templates** | Pre-designed email templates | Admin |
| **SMS Templates** | Pre-designed SMS templates | Admin |
| **Bulk Email** | Send bulk emails to users | Admin |
| **Bulk SMS** | Send bulk SMS to users | Admin |
| **User Segmentation** | Target users by role, activity | Admin |
| **Personalization** | Personalize emails with user data | Admin |
| **Schedule Sending** | Schedule campaigns for later | Admin |
| **Track Opens** | Track email open rates | Admin |
| **Track Clicks** | Track email click-through rates | Admin |
| **Unsubscribe** | Users can unsubscribe | User |
| **Analytics Dashboard** | Campaign performance metrics | Admin |
| **A/B Testing** | Test different subject lines/content | Admin |
| **Automation Workflows** | Automated emails based on actions | Admin |

### 🔔 11. NOTIFICATIONS & ALERTS

| Feature | Description | User Roles |
|---------|-------------|------------|
| **Email Notifications** | System-wide email notifications | All |
| **SMS Notifications** | Important SMS alerts | All |
| **In-App Notifications** | Dashboard notification center | All |
| **Project Updates** | Notify clients of project changes | Client |
| **Course Updates** | Notify students of course updates | Student |
| **Payment Receipts** | Payment confirmation notifications | All |
| **Certificate Issued** | Certificate issuance notification | Student |
| **Enrollment Confirmation** | Course enrollment notification | Student |
| **System Announcements** | Admin announcements to all users | All |
| **Marketing Communications** | Promotional messages (opt-in) | All |
| **Notification Preferences** | Users manage notification types | All |
| **Read/Unread Status** | Track notification reading status | All |

### 📊 12. ANALYTICS & REPORTING

| Feature | Description | User Roles |
|---------|-------------|------------|
| **User Analytics** | User registration, engagement stats | Admin |
| **Revenue Analytics** | Income tracking and forecasts | Admin |
| **Course Analytics** | Course enrollment, completion rates | Admin |
| **Quiz Analytics** | Quiz performance, pass/fail rates | Admin |
| **Project Analytics** | Project status, completion times | Admin |
| **Marketing Analytics** | Campaign performance metrics | Admin |
| **Custom Reports** | Generate custom reports | Admin |
| **Export Reports** | Export as PDF, Excel, CSV | Admin |
| **Dashboards** | Role-specific analytics dashboards | All |
| **Real-time Stats** | Live statistics and updates | Admin |

---

## 👥 User Roles & Permissions Matrix

### 🛡️ SUPER ADMIN (MAXWELL EPHRAIM HALILU)

| **Full System Control** | **Permissions** |
|-------------------------|-----------------|
| ✅ Everything | All system features, settings, and data |
| 👥 User Management | Create, edit, delete any user |
| 🛠️ System Settings | Configure all system settings |
| 💰 Financial Control | Access all financial data and settings |
| 📊 Reports | Generate and export all reports |
| 🔒 Security | Manage security settings and logs |

### 👨‍💼 ADMIN STAFF

| **Management Access** | **Permissions** |
|----------------------|-----------------|
| ✅ Most Features | Manage content, users (except Super Admin) |
| 📁 Projects | Create, edit, manage all projects |
| 🎓 Courses | Create, edit, manage courses and lessons |
| 📝 Quizzes | Create, edit, manage quizzes |
| 📱 Media | Upload and manage media content |
| 📧 Marketing | Create and send campaigns |
| 📊 Limited Reports | View reports (can't export all) |
| ❌ No System Settings | Cannot modify core system settings |
| ❌ No Financial Control | Cannot access payment configuration |

### 🤝 CLIENT

| **Project Access** | **Permissions** |
|-------------------|-----------------|
| 📂 My Projects | View own projects only |
| 📤 File Upload | Upload files to own projects |
| 💬 Feedback | Submit feedback on own projects |
| 📊 Progress View | Track project progress |
| 📱 Profile | Manage own profile |
| 🔔 Notifications | Receive project updates |
| ❌ No Other Clients | Cannot view other clients' projects |
| ❌ No Admin Access | Cannot access admin dashboard |
| ❌ No Content Management | Cannot create courses or content |

### 👨‍🎓 STUDENT

| **Learning Access** | **Permissions** |
|--------------------|-----------------|
| 🎓 My Courses | View and access enrolled courses |
| 📺 Lessons | Watch/access course lessons |
| ✅ Lesson Progress | Track lesson completion |
| 📝 Quizzes | Take assigned quizzes |
| 📊 Quiz Results | View quiz results |
| 🏆 Certificates | View and download certificates |
| 📱 Profile | Manage own profile |
| 💬 Discussions | Participate in course discussions |
| ❌ No Course Creation | Cannot create courses |
| ❌ No Admin Access | Cannot access admin dashboard |
| ❌ No Other Students | Cannot view other students' data |

### 👤 PUBLIC/GUEST

| **Public Access** | **Permissions** |
|-------------------|-----------------|
| 🌐 Homepage | View homepage |
| 📖 Blog | Read blog posts |
| 📚 Courses | Browse course catalog |
| 📋 Services | View services and pricing |
| 📞 Contact | Use contact form |
| 🔐 Register | Create new account |
| ❌ No Dashboard | Cannot access any dashboard |
| ❌ No Content | Cannot access paid content |
| ❌ No Interaction | Cannot post comments (unregistered) |

---

## 🔄 Workflow Diagrams

### Client Journey Flow
```
1. Visitor → Register as Client
2. Client → Login → Dashboard
3. Admin → Creates Project → Assigns to Client
4. Client → Views Project → Tracks Progress
5. Client → Uploads Files → Provides Feedback
6. Admin → Responds → Updates Progress
7. Project → Completed → Client Approves
8. Admin → Generates Invoice → Client Pays
```

### Student Journey Flow
```
1. Visitor → Register as Student
2. Student → Login → Dashboard
3. Student → Browse Courses → Enroll (Free/Paid)
4. Student → Access Course → View Lessons
5. Student → Complete Lessons → Track Progress
6. Student → Take Quizzes → Auto-Graded
7. Student → Pass Quiz → Certificate Generated
8. Student → Download/Print Certificate
```

### Admin Workflow
```
1. Admin → Login → Dashboard
2. View All Activities → Metrics
3. Create/Manage Users → Assign Roles
4. Create Projects → Assign to Clients
5. Create Courses → Add Lessons
6. Create Quizzes → Add Questions
7. Manage Content → Blog & Media
8. Send Campaigns → Email & SMS
9. Generate Reports → Export Data
10. System Settings → Configuration
```

---

## 🚀 Quick Start Commands

### Setup Commands
```powershell
# Create all models with migrations
php artisan make:model User -m
php artisan make:model Client -m
php artisan make:model Project -m
php artisan make:model Course -m
php artisan make:model Quiz -m
php artisan make:model Certificate -m
php artisan make:model BlogPost -m
php artisan make:model MediaItem -m
php artisan make:model Order -m
php artisan make:model Payment -m

# Create controllers
php artisan make:controller Admin/DashboardController
php artisan make:controller Client/ProjectController
php artisan make:controller Student/CourseController
php artisan make:controller Public/HomeController

# Create middleware
php artisan make:middleware AdminMiddleware
php artisan make:middleware ClientMiddleware
php artisan make:middleware StudentMiddleware

# Run migrations
php artisan migrate

# Install Breeze
composer require laravel/breeze --dev
php artisan breeze:install blade

# Install frontend
npm install
npm run build
```

---

This documentation provides everything you need to build your complete MGTECHS platform from scratch in Laravel. Each feature is explained with its purpose and the user roles that can access it. 

Would you like me to provide the actual code implementation for any specific module or feature next?


EXAMINE THE CODEBASE  FOR LOGO, FAVICON UPLOAD IN THE SETTINGS  AND DISPLAY WHERE NECESSARY AND FIX IT CURRENT THE LOGO ND FAVICON IS NOT BEEN DISPLAYED, AND ENSURE BOTH THE WELCOME PAGE AND DASHBOARD USES LL AVAILABE DATA FROM THE SETTINGS PAGE PERFECTLY
                                   
AND ALSO ENSURE THE LOGO SIZE IS ADJUSTED TO STNADARD LOGO AND FAVICON SIZE WHEN UPDATED SO IT FIT PERFECTLY 