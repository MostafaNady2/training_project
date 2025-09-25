@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4 d-flex justify-content-between">
        <div class="btn-group" role="group">
            @auth
                @if(Auth::user()->role === 'candidate')
                    <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Search Jobs</a>
                    <a href="{{ route('applications.my-applications') }}" class="btn btn-secondary">My Applications</a>
                    <a href="{{ route('profile.history') }}" class="btn btn-secondary">Application History</a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Profile</a>
                @elseif(Auth::user()->role === 'employer')
                    <a href="{{ route('jobs.my-jobs') }}" class="btn btn-secondary">My Jobs</a>
                    <a href="{{ route('jobs.create') }}" class="btn btn-secondary">Post New Job</a>
                    <a href="{{ route('applications.received') }}" class="btn btn-secondary">Received Applications</a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Profile</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.all-jobs') }}" class="btn btn-secondary">All Jobs</a>
                    <a href="{{ route('admin.pending-jobs') }}" class="btn btn-secondary">Pending Jobs</a>
                    <a href="{{ route('admin.approved-jobs') }}" class="btn btn-secondary">Approved Jobs</a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Profile</a>
                @endif
            @endauth
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection