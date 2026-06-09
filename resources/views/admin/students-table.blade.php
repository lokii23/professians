@extends('layouts.admin')

@section('content')

<div class="row g-4 mb-4">

    <div class="col-md-12">
        <div class="card-modern">

            <h4>👨‍🎓 Students - {{ $course }}</h4>

            <p class="text-muted">
                List of enrolled students in this section
            </p>

        </div>
    </div>

</div>

<div class="card-modern">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h5 class="mb-2">
                📋 Student List
            </h5>

            @if($sort == 'asc')
                <a href="{{ route('admin.sections.show', ['course' => $course, 'sort' => 'desc']) }}"
                   class="btn btn-sm btn-outline-primary">
                    🔽 Sort Z - A
                </a>
            @else
                <a href="{{ route('admin.sections.show', ['course' => $course, 'sort' => 'asc']) }}"
                   class="btn btn-sm btn-outline-primary">
                    🔼 Sort A - Z
                </a>
            @endif

        </div>

        <a href="{{ route('admin.sections') }}"
           class="btn btn-sm btn-secondary">

            ⬅ Back

        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Last Name</th>

                    <th>First Name</th>

                    <th>Middle Name</th>

                    <th>Email</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @forelse($students as $index => $student)

                <tr>

                    <td>{{ $index + 1 }}</td>

                    <td>
                        {{ $student->last_name }}
                    </td>

                    <td>
                        {{ $student->first_name }}
                    </td>

                    <td>
                        {{ $student->middle_name }}
                    </td>

                    <td>
                        {{ $student->email }}
                    </td>

                    <td>
                        <span class="badge bg-success">
                            Enrolled
                        </span>
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center text-muted">

                        No students found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection