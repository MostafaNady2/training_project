@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Rejected Applications</h1>

    <div class="mb-4">
        <a href="{{ route('applications.my-applications') }}" class="btn btn-secondary">
            Back to My Applications
        </a>
    </div>

    @if ($applications->isEmpty())
        <p>No rejected applications.</p>
    @else
        @foreach ($applications as $application)
            @if($application->job)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Rejected for {{ $application->job->title ?? 'N/A' }}</h5>
                        <p><strong>Status:</strong> <span class="badge bg-danger">Rejected</span></p>
                        <a href="{{ route('jobs.show', $application->job) }}" class="btn btn-info btn-sm">View Job</a>
                    </div>
                </div>
            @endif
        @endforeach
        {{ $applications->links() }}
    @endif
</div>
@endsection
