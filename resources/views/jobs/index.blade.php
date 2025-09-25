@extends('layouts.app')
@section('content')
<div class="container">
    <div class="mb-4 d-flex justify-content-between">
        <div class="btn-group" role="group">
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Search Jobs</a>
            <a href="{{ route('applications.my-applications') }}" class="btn btn-secondary">My Applications</a>
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
    <h2>Jobs</h2>
    <form action="{{ route('jobs.search') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" name="keyword" class="form-control" placeholder="Keyword" value="{{ request('keyword') }}">
            </div>
            <div class="col">
                <input type="text" name="location" class="form-control" placeholder="Location" value="{{ request('location') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    @if ($jobs->isEmpty())
        <p>No jobs available.</p>
    @else
        @foreach ($jobs as $job)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $job->title }}</h5>
                    <p class="card-text">{{ $job->description }}</p>
                    <a href="{{ route('jobs.show', $job) }}" class="btn btn-info">View and Apply</a>
                </div>
            </div>
        @endforeach
        {{ $jobs->links() }}
    @endif
</div>
@endsection