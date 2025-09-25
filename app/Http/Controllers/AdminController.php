<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function pendingJobs()
    {
        // Eager load the 'employer' relationship to get the name of the job poster
        $jobs = Job::where('approved', false)->with('employer')->latest()->paginate(10);
        return view('admin.pending-jobs', compact('jobs'));
    }

    public function approve(Job $job)
    {
        $job->update(['approved' => true]);
        return redirect()->route('admin.pending-jobs')->with('success', 'Job approved.');
    }

    public function reject(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.pending-jobs')->with('success', 'Job rejected.');
    }
    
    public function allJobs()
    {
        // Eager load the 'employer' relationship
        $jobs = Job::with('employer')->latest()->paginate(10);
        return view('admin.all-jobs', compact('jobs'));
    }

    public function approvedJobs()
    {
        // Eager load the 'employer' relationship
        $jobs = Job::where('approved', true)->with('employer')->latest()->paginate(10);
        return view('admin.approved-jobs', compact('jobs'));
    }

    public function userBehavior()
    {
        // Placeholder for monitoring (e.g., user logs)
        return view('admin.user-behavior');
    }
}