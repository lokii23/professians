@extends('layouts.admin')

@section('content')

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card-modern text-center">
            <h3>{{ $examCount }}</h3>
            <p>Total Exams</p>
        </div>
    </div>

    <div class="col-md-3">
            <div class="card-modern text-center">
                <h3>{{ $studentCount }}</h3>
                <p>Students</p>
            </div>
    </div>

    <div class="col-md-3">
            <div class="card-modern text-center">
                <h3>{{ $adminCount }}</h3>
                <p>Admins</p>
            </div>
    </div>


    <div class="col-md-3">
        <div class="card-modern text-center">
            <h3>Active</h3>
            <p>System Status</p>
        </div>
    </div>

</div>
@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">

        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif
{{-- Student Management --}}
<div class="card-modern p-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">
                Student Management
            </h4>

            <p class="text-muted mb-0">
                Manage all registered users
            </p>

        </div>

    </div>

    <div class="table-responsive">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

            <form method="GET"
                action="{{ route('admin.dashboard') }}"
                class="d-flex gap-2 flex-wrap">

                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search student..."
                    value="{{ request('search') }}">

                <select name="role"
                        class="form-control">

                    <option value="">
                        All Roles
                    </option>

                    <option value="student"
                        {{ request('role') == 'student' ? 'selected' : '' }}>
                        Student
                    </option>

                    <option value="admin"
                        {{ request('role') == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                </select>

                <button class="btn btn-dark">

                    Filter

                </button>

            </form>

        </div>
        <table class="table align-middle">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>

                    <th>Role</th>

                    <th width="120">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr>
                         <td>
                            {{ $user->id }}
                        </td>

                        <td>

                            {{ $user->first_name }}
                            {{ $user->middle_name }}
                            {{ $user->last_name }}

                        </td>

                        <td>

                            <span class="badge bg-primary">

                                {{ $user->role }}

                            </span>

                        </td>

                        <td>

                            <button
                                class="btn btn-warning btn-sm rounded-pill px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#showUser{{ $user->id }}">

                                Show

                            </button>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>
        <div class="d-flex justify-content-between align-items-center mt-4">

            <small class="text-muted">
                Showing {{ $users->firstItem() }}
                to {{ $users->lastItem() }}
                of {{ $users->total() }} users
            </small>

            {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}

        </div>
    </div>

</div>

@foreach($users as $user)

<div class="modal fade"
     id="showUser{{ $user->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 overflow-hidden">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title fw-bold">

                    Student Information

                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form action="{{ route('admin.users.update', $user->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="fw-semibold">
                                First Name
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->first_name }}"
                                   readonly>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="fw-semibold">
                                Middle Name
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->middle_name }}"
                                   readonly>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="fw-semibold">
                                Last Name
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->last_name }}"
                                   readonly>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="fw-semibold">
                                Email
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->email }}"
                                   readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="fw-semibold">
                                Contact Number
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->contact_number }}"
                                   readonly>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="fw-semibold">
                                Gender
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->gender }}"
                                   readonly>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="fw-semibold">
                                Birthday
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->birthday }}"
                                   readonly>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="fw-semibold">
                                Age
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->age }}"
                                   readonly>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="fw-semibold">
                            Course
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $user->course }}"
                               readonly>

                    </div>

                    <hr>

                    <div class="mb-3">

                        <label class="fw-semibold">
                            Current Password
                        </label>

                        <div class="input-group">

                            <input type="password"
                                id="password{{ $user->id }}"
                                class="form-control"
                                value="{{ $user->password }}"
                                readonly>

                            <button type="button"
                                    class="btn btn-outline-secondary"
                                    onclick="togglePassword({{ $user->id }})">

                                Show

                            </button>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="fw-semibold">
                            Set New Password
                        </label>

                        <input type="text"
                            name="password"
                            class="form-control"
                            placeholder="Enter new password">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal">

                        Close

                    </button>

                    <button type="submit"
                            class="btn btn-success px-4">

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endforeach
<script>

function togglePassword(id)
{
    let input = document.getElementById('password' + id);

    if(input.type === 'password')
    {
        input.type = 'text';
    }
    else
    {
        input.type = 'password';
    }
}

</script>
@endsection