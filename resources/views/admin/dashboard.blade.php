@extends('layouts.admin')

@section('content')
<style>
    .rounded-circle.shadow-lg{
    transition:.3s ease;
}

.rounded-circle.shadow-lg:hover{
    transform:scale(1.05);
    box-shadow:0 0 25px rgba(13,110,253,.5)!important;
}
</style>
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
                        
                        <td class="d-flex gap-2">

                            @if($user->status == 'active')

                                <form action="{{ route('admin.users.disable', $user->id) }}"
                                    method="POST">

                                    @csrf

                                    <button type="submit"
                                            class="btn btn-danger btn-sm rounded-pill"
                                            onclick="return confirm('Disable this account?')">

                                        Disable

                                    </button>

                                </form>

                            @else

                                <form action="{{ route('admin.users.enable', $user->id) }}"
                                    method="POST">

                                    @csrf

                                    <button type="submit"
                                            class="btn btn-success btn-sm rounded-pill">

                                        Enable

                                    </button>

                                </form>

                            @endif

                            <button class="btn btn-warning btn-sm rounded-pill px-3"
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

        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Header -->
            <div class="modal-header border-0 text-white"
                 style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">

                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-badge me-2"></i>
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

                <div class="modal-body p-4 bg-light">

                    <!-- Profile Section -->
                    <div class="text-center mb-4">

                        @if($user->profile_photo)
                            <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
                                alt="Student Photo"
                                class="rounded-circle shadow-lg"
                                width="160"
                                height="160"
                                data-bs-toggle="modal"
                                data-bs-target="#photoModal{{ $user->id }}"
                                style="
                                    object-fit: cover;
                                    border: 5px solid #0d6efd;
                                    padding: 4px;
                                    background: white;
                                    cursor:pointer;
                                    transition:.3s;">
                        @else
                            <div class="rounded-circle bg-secondary mx-auto shadow"
                                 style="width:160px;height:160px;">
                            </div>
                        @endif

                        <h3 class="fw-bold text-primary mt-3 mb-1">
                            {{ $user->first_name }}
                            {{ $user->last_name }}
                        </h3>

                        <p class="text-muted mb-2">
                            {{ $user->course }}
                        </p>

                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                            {{ ucfirst($user->role) }}
                        </span>

                    </div>

                    <!-- Personal Information -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">

                        <div class="card-header bg-primary text-white fw-semibold">
                            Personal Information
                        </div>

                        <div class="card-body">

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <div class="bg-light border rounded-3 p-3 h-100">
                                        <small class="text-muted">First Name</small>
                                        <div class="fw-semibold">
                                            {{ $user->first_name }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-light border rounded-3 p-3 h-100">
                                        <small class="text-muted">Middle Name</small>
                                        <div class="fw-semibold">
                                            {{ $user->middle_name ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-light border rounded-3 p-3 h-100">
                                        <small class="text-muted">Last Name</small>
                                        <div class="fw-semibold">
                                            {{ $user->last_name }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="bg-light border rounded-3 p-3">
                                        <small class="text-muted">Email Address</small>
                                        <div class="fw-semibold">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="bg-light border rounded-3 p-3">
                                        <small class="text-muted">Contact Number</small>
                                        <div class="fw-semibold">
                                            {{ $user->contact_number }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-light border rounded-3 p-3">
                                        <small class="text-muted">Gender</small>
                                        <div class="fw-semibold">
                                            {{ $user->gender }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-light border rounded-3 p-3">
                                        <small class="text-muted">Birthday</small>
                                        <div class="fw-semibold">
                                            {{ $user->birthday }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="bg-light border rounded-3 p-3">
                                        <small class="text-muted">Age</small>
                                        <div class="fw-semibold">
                                            {{ $user->age }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="bg-light border rounded-3 p-3">
                                        <small class="text-muted">Course</small>
                                        <div class="fw-semibold">
                                            {{ $user->course }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Password Section -->
                    <div class="card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-primary text-white fw-semibold">
                            Password Management
                        </div>

                        <div class="card-body">

                            <label class="fw-semibold mb-2">
                                Set New Password
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control form-control-lg"
                                   placeholder="Enter new password">

                            <small class="text-muted">
                                Leave blank if you don't want to change the password.
                            </small>

                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 bg-light">

                    <button type="button"
                            class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">

                        Close

                    </button>

                    <button type="submit"
                            class="btn btn-primary rounded-pill px-4 shadow-sm">

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@if($user->profile_photo)

<div class="modal fade"
     id="photoModal{{ $user->id }}"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content bg-transparent border-0">

            <!-- X Button -->
            <button type="button"
                    class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal"
                    style="z-index:999;">
            </button>

            <div class="modal-body text-center p-0">

                <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
                     class="img-fluid rounded-4 shadow-lg"
                     style="max-height:90vh;">

            </div>

        </div>

    </div>

</div>

@endif
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