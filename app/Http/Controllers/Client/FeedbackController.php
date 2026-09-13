<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectUpdate;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $updates = ProjectUpdate::with('project')
            ->where('user_id', $request->user()->id)
            ->whereNotNull('client_feedback')
            ->latest()
            ->paginate(15);

        return view('client.feedback.index', compact('updates'));
    }

    public function store(Request $request, Project $project)
    {
        return app(ProjectController::class)->feedback($request, $project);
    }
}
