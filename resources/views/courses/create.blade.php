@extends('layouts.admin')

@section('title', 'Create Course')

@section('content')
    <div class="container mt-4">
        <h2>Create Course</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                          rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Course Category</label>
                <input type="text" name="course_category" class="form-control @error('course_category') is-invalid @enderror"
                       value="{{ old('course_category') }}">
                @error('course_category')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div id="modules-container"></div>

            <button type="button" id="add-module" class="btn btn-secondary mt-3">+ Add Module</button>

            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        let moduleIndex = 0;
        let contentIndexes = {};

        document.getElementById('add-module').addEventListener('click', function () {
            const modulesContainer = document.getElementById('modules-container');
            contentIndexes[moduleIndex] = 0;

            const moduleDiv = document.createElement('div');
            moduleDiv.classList.add('card', 'mt-3', 'p-3');
            moduleDiv.setAttribute('data-module-index', moduleIndex);
            moduleDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5>Module ${moduleIndex + 1}</h5>
                    <button type="button" class="btn btn-sm btn-danger remove-module">Remove Module</button>
                </div>
                <div class="mb-2">
                    <label class="form-label">Module Title</label>
                    <input type="text" name="modules[${moduleIndex}][title]" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Module Description</label>
                    <textarea name="modules[${moduleIndex}][description]" class="form-control" rows="2" required></textarea>
                </div>
                <div class="contents-container"></div>
                <button type="button" class="btn btn-outline-primary add-content mt-2" data-module-index="${moduleIndex}">
                    + Add Content
                </button>
            `;

            modulesContainer.appendChild(moduleDiv);
            moduleIndex++;
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-content')) {
                const moduleIdx = e.target.dataset.moduleIndex;
                if (!contentIndexes[moduleIdx]) contentIndexes[moduleIdx] = 0;
                const contentIdx = contentIndexes[moduleIdx]++;

                const contentHTML = `
                    <div class="content-block mt-2 p-2 rounded border position-relative">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-5">
                                <select name="modules[${moduleIdx}][contents][${contentIdx}][type]" class="form-select" required>
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="text">Text</option>
                                    <option value="link">Link</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="modules[${moduleIdx}][contents][${contentIdx}][value]" class="form-control" placeholder="Content Value" required>
                            </div>
                            <div class="col-md-1 d-flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-danger remove-content" title="Remove">Remove</button>
                            </div>
                        </div>
                    </div>
                `;

                e.target.previousElementSibling.insertAdjacentHTML('beforeend', contentHTML);
            }

            if (e.target.classList.contains('remove-content')) {
                e.target.closest('.content-block').remove();
            }

            if (e.target.classList.contains('remove-module')) {
                e.target.closest('.card').remove();
            }
        });
    </script>
@endsection
