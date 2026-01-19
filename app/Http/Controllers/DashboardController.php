<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $candidates = Candidate::orderByDesc('vote_count')->get();
        $data = [
            'candidates' => $candidates,
            'maxCount' => $candidates->max('vote_count'),
        ];
        return Inertia::render('Dashboard', $data);
    }

    public function reset() {
        Candidate::query()->update(['vote_count' => 0]);
        return back();
    }
}
