@extends('layouts.app')

@section('content')
<div class="container">
	<div class="mb-4 d-flex justify-content-between">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.all-jobs') }}" class="btn btn-secondary">All Jobs</a>
            <a href="{{ route('admin.pending-jobs') }}" class="btn btn-secondary">Pending Jobs</a>
            <a href="{{ route('admin.approved-jobs') }}" class="btn btn-primary">Approved Jobs</a>
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
    <h2>Approved Jobs</h2>

    @if($jobs->count())
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Approved On</th>
                    <th>Posted By</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->updated_at->format('Y-m-d') }}</td>
                        <td>{{ $job->employer->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $jobs->links() }}
    @else
        <p>No approved jobs found.</p>
    @endif
</div>
@endsection
