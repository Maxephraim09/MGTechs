<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::with('client')->latest()->paginate(15),
            'clients' => User::clients()->orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.projects.create', [
            'clients' => User::clients()->active()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateProject($request);
        $client = User::find($validated['client_id']);

        $validated['project_code'] = $this->generateProjectCode();
        $validated['admin_id'] = $request->user()->id;
        $validated['client_name'] = $validated['client_name'] ?: $client?->name;
        $validated['client_email'] = $validated['client_email'] ?: $client?->email;
        $validated['project_amount'] = $validated['project_amount'] ?? 0;
        $validated['amount_paid'] = $validated['amount_paid'] ?? 0;
        $validated['balance'] = (float) $validated['project_amount'] - (float) ($validated['amount_paid'] ?? 0);
        $validated['end_date'] = $validated['end_date'] ?? $validated['deadline'] ?? null;

        $this->storePrimaryUploads($request, $validated);

        $project = Project::create($validated);
        $this->storeFiles($request, $project);

        ProjectUpdate::create([
            'project_id' => $project->id,
            'user_id' => $request->user()->id,
            'content' => 'Project created.',
            'admin_update' => 'Project created.',
            'status' => $project->status,
            'project_url' => $project->project_url,
        ]);

        return redirect()
            ->route('admin.projects.show', $project)
            ->with('success', 'Project created successfully. Project Code: '.$project->project_code);
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', [
            'project' => $project->load(['client', 'admin', 'updates.user', 'files']),
        ]);
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', [
            'project' => $project->load('files'),
            'clients' => User::clients()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $this->validateProject($request, $project);
        $client = User::find($validated['client_id']);

        $validated['client_name'] = $validated['client_name'] ?: $client?->name;
        $validated['client_email'] = $validated['client_email'] ?: $client?->email;
        $validated['project_amount'] = $validated['project_amount'] ?? 0;
        $validated['amount_paid'] = $validated['amount_paid'] ?? 0;
        $validated['balance'] = (float) $validated['project_amount'] - (float) ($validated['amount_paid'] ?? 0);
        $validated['end_date'] = $validated['end_date'] ?? $validated['deadline'] ?? null;

        $this->storePrimaryUploads($request, $validated, $project);
        $project->update($validated);
        $this->storeFiles($request, $project);

        return redirect()->route('admin.projects.show', $project)->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        foreach (['image', 'agreement_file', 'proposal_file'] as $field) {
            if ($project->{$field}) {
                Storage::disk('public')->delete($project->{$field});
            }
        }

        foreach ($project->files as $file) {
            if ($file->path) {
                Storage::disk('public')->delete($file->path);
            }
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function updateStatus(Request $request, Project $project)
    {
        $validated = $request->validate([
            'status' => 'required|in:planning,pending,in_progress,review,completed,cancelled',
            'progress_percentage' => 'nullable|integer|min:0|max:100',
            'admin_update' => 'nullable|string|max:5000',
            'project_url' => 'nullable|url|max:255',
        ]);

        $project->update([
            'status' => $validated['status'],
            'progress_percentage' => $validated['progress_percentage'] ?? $project->progress_percentage,
            'project_url' => $validated['project_url'] ?? $project->project_url,
        ]);

        ProjectUpdate::create([
            'project_id' => $project->id,
            'user_id' => $request->user()->id,
            'content' => $validated['admin_update'] ?? 'Status updated to '.$project->status_text.'.',
            'admin_update' => $validated['admin_update'] ?? null,
            'status' => $project->status,
            'project_url' => $project->project_url,
        ]);

        return back()->with('success', 'Project status updated successfully.');
    }

    public function addReview(Request $request, Project $project)
    {
        return $this->updateStatus($request, $project);
    }

    private function validateProject(Request $request, ?Project $project = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:users,id',
            'client_name' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'client_phone' => 'nullable|string|max:40',
            'client_address' => 'nullable|string',
            'project_amount' => 'nullable|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0|lte:project_amount',
            'start_date' => 'nullable|date',
            'deadline' => 'nullable|date',
            'end_date' => 'nullable|date',
            'project_url' => 'nullable|url|max:255',
            'status' => 'required|in:planning,pending,in_progress,review,completed,cancelled',
            'progress_percentage' => 'nullable|integer|min:0|max:100',
            'image' => 'nullable|image|max:4096',
            'agreement_file' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'proposal_file' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
            'files.*' => 'nullable|file|max:10240',
        ]);
    }

    private function storePrimaryUploads(Request $request, array &$validated, ?Project $project = null): void
    {
        foreach ([
            'image' => 'projects/images',
            'agreement_file' => 'projects/agreements',
            'proposal_file' => 'projects/proposals',
        ] as $field => $directory) {
            if (! $request->hasFile($field)) {
                continue;
            }

            if ($project?->{$field}) {
                Storage::disk('public')->delete($project->{$field});
            }

            $validated[$field] = $request->file($field)->store($directory, 'public');
        }
    }

    private function storeFiles(Request $request, Project $project): void
    {
        foreach ($request->file('files', []) as $file) {
            $path = $file->store('projects/files', 'public');

            ProjectFile::create([
                'project_id' => $project->id,
                'uploaded_by' => $request->user()->id,
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'category' => 'project',
            ]);
        }
    }

    private function generateProjectCode(): string
    {
        do {
            $code = 'PRJ-'.strtoupper(Str::random(8));
        } while (Project::where('project_code', $code)->exists());

        return $code;
    }
}
