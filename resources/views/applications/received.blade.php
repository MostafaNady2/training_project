@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Received Applications</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if ($applications->isEmpty())
        <p>No applications received.</p>
    @else
        @foreach ($applications as $application)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Application for {{ $application->job->title ?? 'N/A' }}</h5>
                    <p><strong>Candidate:</strong> {{ $application->candidate->name ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-info text-dark">{{ ucfirst($application->status) }}</span></p>
                    <p><strong>Contact Email:</strong> {{ $application->contact_email }}</p>
                    <p><strong>Contact Phone:</strong> {{ $application->contact_phone ?? 'N/A' }}</p>
                    
                    @if ($application->resume)
                        <a href="{{ asset('storage/' . $application->resume) }}" class="btn btn-secondary">Download Resume</a>
                    @endif

                    @if ($application->status === 'pending')
                        {{-- Accept --}}
                        <form action="{{ route('applications.accept', $application) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH') {{-- ✅ Fix --}}
                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                        </form>

                        {{-- Reject --}}
                        <form action="{{ route('applications.reject', $application) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH') {{-- ✅ Fix --}}
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
        {{ $applications->links() }}
    @endif
</div>
@endsection
