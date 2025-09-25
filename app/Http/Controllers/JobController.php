<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('approved', true)->latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function search(Request $request)
    {
        $query = Job::where('approved', true);

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->input('keyword') . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        $jobs = $query->latest()->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'skills' => 'required|string',
            'qualifications' => 'required|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gt:salary_min',
            'benefits' => 'nullable|string',
            'location' => 'required|string|max:255',
            'work_type' => 'required|in:remote,on-site,hybrid',
            'deadline' => 'nullable|date',
            'company_logo' => 'image|nullable|max:2048',
        ]);

        if ($request->hasFile('company_logo')) {
            $validated['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        $validated['employer_id'] = auth()->id();
        $validated['approved'] = false;

        Job::create($validated);

        return redirect()->route('jobs.my-jobs')->with('success', 'Job posted, awaiting approval.');
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function myJobs()
    {
        $jobs = auth()->user()->jobs()->latest()->paginate(10);
        return view('jobs.my-jobs', compact('jobs'));
    }

    public function edit(Job $job)
    {
        if (auth()->id() !== $job->employer_id) abort(403);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        if (auth()->id() !== $job->employer_id) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'skills' => 'required|string',
            'qualifications' => 'required|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gt:salary_min',
            'benefits' => 'nullable|string',
            'location' => 'required|string|max:255',
            'work_type' => 'required|in:remote,on-site,hybrid',
            'deadline' => 'nullable|date',
            'company_logo' => 'image|nullable|max:2048',
        ]);

        if ($request->hasFile('company_logo')) {
            // Delete old logo if it exists
            if ($job->company_logo && Storage::exists('public/' . $job->company_logo)) {
                Storage::delete('public/' . $job->company_logo);
            }
            $validated['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        }

        $job->update($validated);

        return redirect()->route('jobs.my-jobs')->with('success', 'Job updated.');
    }

    public function destroy(Job $job)
    {
        if (auth()->id() !== $job->employer_id) abort(403);

        if ($job->company_logo && Storage::exists('public/' . $job->company_logo)) {
            Storage::delete('public/' . $job->company_logo);
        }

        $job->delete();

        return redirect()->route('jobs.my-jobs')->with('success', 'Job deleted.');
    }
}