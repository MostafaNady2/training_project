@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mb-4 d-flex justify-content-between">
        <div class="btn-group" role="group">
            <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Search Jobs</a>
            <a href="{{ route('applications.my-applications') }}" class="btn btn-secondary">My Applications</a>
            <a href="{{ route('profile.history') }}" class="btn btn-primary">Application History</a>
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
    <h1>Application History</h1>
    @if ($applications->isEmpty())
        <p>No application history.</p>
    @else
        @foreach ($applications as $application)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $application->job->title }}</h5>
                    <p><strong>Status:</strong> {{ $application->status }}</p>
                    <a href="{{ route('jobs.show', $application->job) }}" class="btn btn-info">View Job</a>
                </div>
            </div>
        @endforeach
        {{ $applications->links() }}
    @endif
</div>
@endsection