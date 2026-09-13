<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $projectsQuery = Project::forClient($request->user());

        return view('dashboard.client', [
            'activeProjects' => (clone $projectsQuery)->active()->count(),
            'completedProjects' => Project::forClient($request->user())->completed()->count(),
            'totalFiles' => ProjectFile::whereHas('project', fn ($query) => $query->forClient($request->user()))->count(),
            'projects' => Project::forClient($request->user())->latest()->limit(5)->get(),
            'stats' => [
                'total' => Project::forClient($request->user())->count(),
                'active' => Project::forClient($request->user())->active()->count(),
                'completed' => Project::forClient($request->user())->completed()->count(),
                'pending' => Project::forClient($request->user())->whereIn('status', ['planning', 'pending'])->count(),
                'files' => ProjectFile::whereHas('project', fn ($query) => $query->forClient($request->user()))->count(),
            ],
        ]);
    }
}
