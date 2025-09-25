@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4 d-flex justify-content-between">
        <div class="btn-group" role="group">
            <a href="{{ route('jobs.my-jobs') }}" class="btn btn-primary">My Jobs</a>
            <a href="{{ route('jobs.create') }}" class="btn btn-secondary">Post New Job</a>
            <a href="{{ route('applications.received') }}" class="btn btn-secondary">Received Applications</a>
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
    
    <h2>My Jobs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($jobs->isEmpty())
        <p>You haven't posted any jobs yet.</p>
    @else
        @foreach ($jobs as $job)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $job->title }}</h5>
                    <p>Status: {{ $job->approved ? 'Approved' : 'Pending' }}</p>
                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-info">View</a>
                    <a href="{{ route('jobs.edit', $job) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('jobs.destroy', $job) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
        {{ $jobs->links() }}
    @endif
</div>
@endsection