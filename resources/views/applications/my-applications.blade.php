@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mb-4 d-flex justify-content-between">
        <div class="btn-group" role="group">
            <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Search Jobs</a>
            <a href="{{ route('applications.my-applications') }}" class="btn btn-primary">My Applications</a>
            <a href="{{ route('profile.history') }}" class="btn btn-secondary">Application History</a>
        </div>
        <div class="d-flex align-items-center">
            @auth
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark me-3">{{ Auth::user()->name }}</a>
            @endauth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Log Out</button>
            </form>
        </div>
    </div>

    <h1>My Applications</h1>
    @if ($applications->isEmpty())
        <p>No applications yet.</p>
    @else
        <div class="list-group">
            @foreach ($applications as $application)
                @if($application->job)
                    <div class="list-group-item list-group-item-action mb-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Applied for: {{ $application->job->title }}</h5>
                            <small class="text-muted">
                                @if($application->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($application->status === 'accepted')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </small>
                        </div>
                        <p class="mb-1">Application Date: {{ $application->created_at->format('M d, Y') }}</p>

                        <div class="mt-2">
                            @if($application->status === 'pending')
                                {{-- Cancel Application (for applicants) --}}
                                <form action="{{ route('applications.cancel', $application) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning btn-sm">Cancel Application</button>
                                </form>

                                {{-- Employer Actions --}}
                                @if(Auth::check() && Auth::user()->role === 'employer')
                                    <form action="{{ route('applications.accept', $application) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                    </form>

                                    <form action="{{ route('applications.reject', $application) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH') {{-- 👈 Fix added --}}
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @endif
                            @endif

                            <a href="{{ route('jobs.show', $application->job) }}" class="btn btn-info btn-sm">View Job</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{ $applications->links() }}
    @endif
</div>
@endsection
