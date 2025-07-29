@extends('layouts.admin')

@section('title', 'Welcome')

@section('content')
    <h1>Welcome to the Admin Panel</h1>
    <p>This is your dashboard or landing page.</p>

    <h3 class="mt-4">Courses List</h3>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

   @if($courses->count() > 0)
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $index => $course)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($course->description, 50) }}</td>
                    <td>{{ $course->category ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No courses found.</p>
@endif

@endsection
