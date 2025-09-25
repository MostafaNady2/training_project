@extends('layouts.app')

@section('content')
<div class="container">
	<div class="mb-4 d-flex justify-content-between">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.all-jobs') }}" class="btn btn-primary">All Jobs</a>
            <a href="{{ route('admin.pending-jobs') }}" class="btn btn-secondary">Pending Jobs</a>
            <a href="{{ route('admin.approved-jobs') }}" class="btn btn-secondary">Approved Jobs</a>
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
    <h2>All Jobs</h2>

    @if($jobs->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Status</th>
                    <th>Posted By</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>
                            @if($job->approved)
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>{{ $job->employer->name ?? 'N/A' }}</td>
                        <td>{{ $job->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $jobs->links() }}
    @else
        <p>No jobs found.</p>
    @endif
</div>
@endsection
