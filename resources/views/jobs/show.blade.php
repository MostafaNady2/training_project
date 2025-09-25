@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ $job->title }}</h1>
    @if($job->company_logo)
        <img src="{{ asset('storage/' . $job->company_logo) }}" alt="Company Logo" width="100" class="mb-3">
    @endif
    <p><strong>Description:</strong> {{ $job->description }}</p>
    <p><strong>Responsibilities:</strong> {{ $job->responsibilities }}</p>
    <p><strong>Skills:</strong> {{ $job->skills }}</p>
    <p><strong>Qualifications:</strong> {{ $job->qualifications }}</p>
    <p><strong>Salary Range:</strong> ${{ $job->salary_min ?? 'N/A' }} - ${{ $job->salary_max ?? 'N/A' }}</p>
    <p><strong>Benefits:</strong> {{ $job->benefits ?? 'N/A' }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Work Type:</strong> {{ $job->work_type }}</p>
    <p><strong>Deadline:</strong> {{ $job->deadline ?? 'N/A' }}</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(auth()->check() && auth()->user()->role === 'candidate')
        <hr>
        <h3>Apply for this Job</h3>
        <form action="{{ route('applications.store', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="resume">Resume</label>
                <input type="file" name="resume" class="form-control @error('resume') is-invalid @enderror" id="resume">
                @error('resume')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="contact_email">Email</label>
                <input type="email" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" placeholder="Email" value="{{ old('contact_email', auth()->user()->email) }}">
                @error('contact_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="contact_phone">Phone</label>
                <input type="text" name="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" placeholder="Phone" value="{{ old('contact_phone', auth()->user()->phone ?? '') }}">
                @error('contact_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    @elseif(auth()->check() && auth()->user()->role === 'employer' && auth()->id() === $job->employer_id)
        <a href="{{ route('jobs.edit', $job) }}" class="btn btn-primary">Edit Job</a>
    @else
        <p>Please <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a> as a candidate to apply for this job.</p>
    @endif
</div>
@endsection