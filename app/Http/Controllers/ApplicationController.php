<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job)
    {
        $validated = $request->validate([
            'resume' => 'file|nullable|max:2048|mimes:pdf,doc,docx',
            'contact_email' => 'email|nullable',
            'contact_phone' => 'string|nullable',
        ]);

        if ($request->hasFile('resume')) {
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        $validated['job_id'] = $job->id;
        $validated['candidate_id'] = auth()->id();

        Application::create($validated);

        return redirect()->route('jobs.show', $job)->with('success', 'Applied successfully.');
    }

    public function myApplications()
    {
        $applications = auth()->user()->applications()->with('job')->paginate(10);
        return view('applications.my-applications', compact('applications'));
    }

    public function pending()
    {
        $applications = auth()->user()->applications()->where('status', 'pending')->paginate(10);
        return view('applications.pending', compact('applications'));
    }

    public function approved()
    {
        $applications = auth()->user()->applications()->where('status', 'accepted')->paginate(10);
        return view('applications.approved', compact('applications'));
    }

    public function rejected()
    {
        $applications = auth()->user()->applications()->where('status', 'rejected')->paginate(10);
        return view('applications.rejected', compact('applications'));
    }

    public function cancel(Application $application)
    {
        if (auth()->id() !== $application->candidate_id) abort(403);

        $application->delete();
        return redirect()->route('applications.my-applications')->with('success', 'Application cancelled.');
    }

    public function received()
    {
        $applications = Application::whereHas('job', function ($query) {
            $query->where('employer_id', auth()->id());
        })->with('candidate')->paginate(10);
        return view('applications.received', compact('applications'));
    }

    public function accept(Application $application)
    {
        if (auth()->id() !== $application->job->employer_id) abort(403);

        $application->update(['status' => 'accepted']);
        return redirect()->route('applications.received')->with('success', 'Application accepted.');
    }

    public function reject(Application $application)
    {
        if (auth()->id() !== $application->job->employer_id) abort(403);

        $application->update(['status' => 'rejected']);
        return redirect()->route('applications.received')->with('success', 'Application rejected.');
    }
}