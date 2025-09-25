@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Post a Job</h1>
    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <textarea name="responsibilities" class="form-control @error('responsibilities') is-invalid @enderror" placeholder="Responsibilities" required>{{ old('responsibilities') }}</textarea>
            @error('responsibilities')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <textarea name="skills" class="form-control @error('skills') is-invalid @enderror" placeholder="Skills" required>{{ old('skills') }}</textarea>
            @error('skills')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <textarea name="qualifications" class="form-control @error('qualifications') is-invalid @enderror" placeholder="Qualifications" required>{{ old('qualifications') }}</textarea>
            @error('qualifications')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="number" step="0.01" name="salary_min" class="form-control @error('salary_min') is-invalid @enderror" placeholder="Salary Min" value="{{ old('salary_min') }}">
            @error('salary_min')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="number" step="0.01" name="salary_max" class="form-control @error('salary_max') is-invalid @enderror" placeholder="Salary Max" value="{{ old('salary_max') }}">
            @error('salary_max')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <textarea name="benefits" class="form-control @error('benefits') is-invalid @enderror" placeholder="Benefits">{{ old('benefits') }}</textarea>
            @error('benefits')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" placeholder="Location" value="{{ old('location') }}" required>
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <select name="work_type" class="form-control @error('work_type') is-invalid @enderror" required>
                <option value="">Select Work Type</option>
                <option value="remote" {{ old('work_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                <option value="on-site" {{ old('work_type') == 'on-site' ? 'selected' : '' }}>On-site</option>
                <option value="hybrid" {{ old('work_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
            @error('work_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline') }}">
            @error('deadline')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="file" name="company_logo" class="form-control @error('company_logo') is-invalid @enderror">
            @error('company_logo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Post Job</button>
    </form>
</div>
@endsection