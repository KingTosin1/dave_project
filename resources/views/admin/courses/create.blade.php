<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Add New Course</h1>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary btn-custom">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.courses.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="code" class="form-label">Course Code</label>
                                    <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" required>
                                    @error('code') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Course Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="unit" class="form-label">Credit Unit</label>
                                    <input type="number" class="form-control" id="unit" name="unit" value="{{ old('unit') }}" min="1" max="6" required>
                                    @error('unit') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="semester" class="form-label">Semester</label>
                                    <select class="form-control" id="semester" name="semester" required>
                                        <option value="">Select Semester</option>
                                        <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>First Semester</option>
                                        <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Second Semester</option>
                                    </select>
                                    @error('semester') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <select class="form-control" id="level" name="level" required>
                                        <option value="">Select Level</option>
                                        <option value="100" {{ old('level') == '100' ? 'selected' : '' }}>100</option>
                                        <option value="200" {{ old('level') == '200' ? 'selected' : '' }}>200</option>
                                        <option value="300" {{ old('level') == '300' ? 'selected' : '' }}>300</option>
                                        <option value="400" {{ old('level') == '400' ? 'selected' : '' }}>400</option>
                                    </select>
                                    @error('level') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-custom">
                                <i class="fas fa-save me-2"></i>Create Course
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
