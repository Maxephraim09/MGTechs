<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::forClient($request->user())->latest();

        return view('client.projects.index', [
            'projects' => $query->paginate(10),
            'stats' => [
                'total' => Project::forClient($request->user())->count(),
                'active' => Project::forClient($request->user())->active()->count(),
                'completed' => Project::forClient($request->user())->completed()->count(),
            ],
        ]);
    }

    public function show(Request $request, Project $project)
    {
        $this->authorizeProject($request, $project);

        return view('client.projects.show', [
            'project' => $project->load(['updates.user', 'files']),
            'updates' => $project->updates()->with('user')->latest()->paginate(10),
        ]);
    }

    public function upload(Request $request, Project $project)
    {
        $this->authorizeProject($request, $project);

        $validated = $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        $file = $validated['file'];
        $path = $file->store('projects/client-files', 'public');

        ProjectFile::create([
            'project_id' => $project->id,
            'uploaded_by' => $request->user()->id,
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'category' => 'client',
        ]);

        return back()->with('success', 'File uploaded successfully.');
    }

    public function download(Request $request, Project $project, ProjectFile $file)
    {
        $this->authorizeProject($request, $project);

        abort_unless($file->project_id === $project->id && $file->path, 404);

        return Storage::disk('public')->download($file->path, $file->filename);
    }

    public function feedback(Request $request, Project $project)
    {
        $this->authorizeProject($request, $project);

        $validated = $request->validate([
            'client_feedback' => 'required|string|max:5000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        ProjectUpdate::create([
            'project_id' => $project->id,
            'user_id' => $request->user()->id,
            'content' => $validated['client_feedback'],
            'client_feedback' => $validated['client_feedback'],
            'rating' => $validated['rating'] ?? null,
            'status' => $project->status,
        ]);

        return back()->with('success', 'Feedback submitted successfully.');
    }

    public function rateCompany(Request $request, Project $project)
    {
        $this->authorizeProject($request, $project);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        ProjectUpdate::create([
            'project_id' => $project->id,
            'user_id' => $request->user()->id,
            'content' => $validated['review_text'] ?? 'Client rated the company.',
            'client_feedback' => $validated['review_text'] ?? null,
            'rating' => $validated['rating'],
            'status' => $project->status,
        ]);

        return back()->with('success', 'Thank you for rating our service.');
    }

    public function requestNewProject()
    {
        return view('client.projects.request');
    }

    public function storeRequest(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'budget' => 'nullable|numeric|min:0',
            'timeline' => 'nullable|string|max:255',
        ]);

        $project = Project::create([
            'project_code' => 'REQ-'.now()->format('YmdHis'),
            'client_id' => $request->user()->id,
            'client_name' => $request->user()->name,
            'client_email' => $request->user()->email,
            'title' => $validated['title'],
            'description' => $validated['description']."\n\nTimeline: ".($validated['timeline'] ?? 'Not specified'),
            'project_amount' => $validated['budget'] ?? 0,
            'amount_paid' => 0,
            'balance' => $validated['budget'] ?? 0,
            'status' => 'pending',
            'progress_percentage' => 0,
        ]);

        ProjectUpdate::create([
            'project_id' => $project->id,
            'user_id' => $request->user()->id,
            'content' => 'Client submitted a new project request.',
            'client_feedback' => $validated['description'],
            'status' => 'pending',
        ]);

        return redirect()->route('client.projects.show', $project)->with('success', 'Project request submitted successfully.');
    }

    private function authorizeProject(Request $request, Project $project): void
    {
        abort_unless(
            $project->client_id === $request->user()->id || $project->client_email === $request->user()->email,
            403
        );
    }
}
