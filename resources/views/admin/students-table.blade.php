@extends('layouts.admin')

@section('content')

<div class="row g-4 mb-4">

    <!-- HEADER CARD -->
    <div class="col-md-12">
        <div class="card-modern">
            <h4>👨‍🎓 Students - {{ $course }}</h4>
            <p class="text-muted">List of enrolled students in this section</p>
        </div>
    </div>

</div>

<!-- TABLE CARD -->
<div class="card-modern">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>📋 Student List</h5>

        <a href="{{ route('admin.sections') }}" class="btn btn-sm btn-secondary">
            ⬅ Back
        </a>
    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>
                        <strong>{{ $student->name }}</strong>
                    </td>

                    <td>{{ $student->email }}</td>

                    <td>
                        <span class="badge bg-success">Enrolled</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        No students found
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection