@extends('layouts.app')

@section('content')
<div class="container">
	<div class="mb-4 d-flex justify-content-between">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.all-jobs') }}" class="btn btn-secondary">All Jobs</a>
            <a href="{{ route('admin.pending-jobs') }}" class="btn btn-primary">Pending Jobs</a>
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
    <h2>Pending Jobs</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($jobs->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Posted By</th>
                    <th>Posted On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->employer->name ?? 'N/A' }}</td>
                        <td>{{ $job->created_at->format('Y-m-d') }}</td>
                        <td>
                            {{-- Approve uses POST --}}
                            <form action="{{ route('admin.approve', $job) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>

                            {{-- Reject uses DELETE --}}
                            <form action="{{ route('admin.reject', $job) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $jobs->links() }}
    @else
        <p>No pending jobs at the moment.</p>
    @endif
</div>
@endsection
