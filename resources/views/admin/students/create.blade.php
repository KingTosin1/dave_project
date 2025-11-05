<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Add New Student</h1>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-secondary btn-custom">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.students.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="matric_no" class="form-label">Matric Number</label>
                                    <input type="text" class="form-control" id="matric_no" name="matric_no" value="{{ old('matric_no') }}" required>
                                    @error('matric_no') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}" required>
                                    @error('department') <div class="text-danger">{{ $message }}</div> @enderror
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

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-custom">
                                <i class="fas fa-save me-2"></i>Create Student
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
