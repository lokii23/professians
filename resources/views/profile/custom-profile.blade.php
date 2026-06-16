@extends('layouts.student')

@section('content')

<style>

    body{
        background:
        linear-gradient(
            135deg,
            #0f172a,
            #111827,
            #1e293b
        );

        min-height:100vh;
    }

    .profile-wrapper{
        max-width:1200px;
        margin:auto;
    }

    .profile-card{
        background:rgba(15,23,42,.72);
        border:1px solid rgba(255,255,255,.06);
        backdrop-filter:blur(14px);
        border-radius:28px;
        box-shadow:0 15px 35px rgba(0,0,0,.35);
    }

    .left-card{
        padding:35px 28px;
    }

    .right-card{
        padding:40px;
    }

    .profile-avatar{
        width:115px;
        height:115px;
        border-radius:50%;
        object-fit:cover;
        border:4px solid rgba(255,255,255,.12);
        box-shadow:0 0 30px rgba(59,130,246,.35);
        cursor:pointer;
        transition:.3s ease;
    }

    .profile-avatar:hover{
        transform:scale(1.08);
        box-shadow:0 0 40px rgba(59,130,246,.6);
    }

    .avatar-placeholder{
        width:115px;
        height:115px;
        border-radius:50%;
        background:
        linear-gradient(
            135deg,
            #2563eb,
            #3b82f6
        );

        display:flex;
        align-items:center;
        justify-content:center;

        font-size:42px;
        font-weight:800;
        color:white;

        margin:auto;

        box-shadow:0 0 30px rgba(59,130,246,.35);
    }

    .student-name{
        color:white;
        font-size:24px;
        font-weight:700;
        margin-top:20px;
    }

    .student-role{
        color:#60a5fa;
        font-size:14px;
    }

    .info-box{
        background:rgba(255,255,255,.04);
        border:1px solid rgba(255,255,255,.05);
        border-radius:18px;
        padding:16px;
        margin-bottom:14px;
    }

    .info-label{
        color:#94a3b8;
        font-size:12px;
        margin-bottom:4px;
    }

    .info-value{
        color:white;
        font-weight:600;
        font-size:14px;
    }

    .profile-title{
        color:white;
        font-size:30px;
        font-weight:800;
        margin-bottom:6px;
    }

    .profile-subtitle{
        color:#94a3b8;
        font-size:14px;
    }

    .form-label{
        color:#cbd5e1;
        font-size:13px;
        margin-bottom:8px;
    }

    .profile-input{
        width:100%;
        background:rgba(255,255,255,.05);
        border:1px solid rgba(255,255,255,.08);
        border-radius:16px;
        padding:14px 16px;
        color:white;
        outline:none;
        transition:.3s ease;
        font-size:14px;
    }

    .profile-input:focus{
        border-color:#3b82f6;
        box-shadow:0 0 0 4px rgba(59,130,246,.15);
    }

    .profile-input::placeholder{
        color:#64748b;
    }

    .profile-btn{
        border:none;
        padding:13px 28px;
        border-radius:16px;

        background:
        linear-gradient(
            135deg,
            #2563eb,
            #3b82f6
        );

        color:white;
        font-weight:600;
        transition:.3s ease;
    }

    .profile-btn:hover{
        transform:translateY(-2px);
        box-shadow:0 12px 25px rgba(37,99,235,.30);
    }

    .secondary-btn{
        background:rgba(255,255,255,.06);
        border:1px solid rgba(255,255,255,.08);
    }

    .secondary-btn:hover{
        background:rgba(255,255,255,.10);
    }

    .success-alert{
        background:rgba(34,197,94,.12);
        border:1px solid rgba(34,197,94,.28);
        color:#86efac;
        padding:14px 18px;
        border-radius:16px;
        margin-bottom:24px;
    }

    .custom-modal{
        background:
        linear-gradient(
            135deg,
            #0f172a,
            #1e293b
        );

        border:1px solid rgba(255,255,255,.08);
        border-radius:24px;
    }

    .modal-header,
    .modal-footer{
        border-color:rgba(255,255,255,.08);
    }

    .btn-close{
        filter:invert(1);
    }

</style>

<div class="container py-5">

    <div class="profile-wrapper">

        <div class="row g-4">

            <!-- LEFT SIDE -->

            <div class="col-lg-4">

                <div class="profile-card left-card text-center">

                    @if(auth()->user()->profile_photo)

                        <img
                            src="{{ asset('storage/profile_photos/' . auth()->user()->profile_photo) }}"
                            class="profile-avatar"
                            style="cursor:pointer"
                            data-bs-toggle="modal"
                            data-bs-target="#photoModal">

                    @else

                        <div class="avatar-placeholder">
                            {{ strtoupper(substr(auth()->user()->first_name,0,1)) }}
                        </div>

                    @endif

                    <div class="student-name">

                        {{ auth()->user()->first_name }}
                        {{ auth()->user()->last_name }}

                    </div>

                    <div class="student-role">

                        Student Account

                    </div>
                    <div class="mt-3">

                        <div style="
                            color:#cbd5e1;
                            font-size:13px;
                            line-height:1.7;
                            background:rgba(255,255,255,.04);
                            border:1px solid rgba(255,255,255,.06);
                            border-radius:14px;
                            padding:12px;
                        ">

                            {{ auth()->user()->bio ?: 'No bio added yet.' }}

                        </div>

                    </div>
                    
                    <div class="mt-4 text-start">

                        <div class="info-box">

                            <div class="info-label">

                                Email Address

                            </div>

                            <div class="info-value">

                                {{ auth()->user()->email }}

                            </div>
                            
                        </div>
                        
                        <div class="info-box">

                            <div class="info-label">

                                Course

                            </div>

                            <div class="info-value">

                                {{ auth()->user()->course }}

                            </div>

                        </div>
                        
                        <div class="info-box">

                            <div class="info-label">

                                Contact Number

                            </div>

                            <div class="info-value">

                                {{ auth()->user()->contact_number }}

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!-- RIGHT SIDE -->

            <div class="col-lg-8">

                <div class="profile-card right-card">

                    <div class="mb-4">

                        <div class="profile-title">

                            My Account Profile

                        </div>

                        <div class="profile-subtitle">

                            Update your personal information and security

                        </div>

                    </div>

                    @if(session('success'))

                        <div class="success-alert">

                            {{ session('success') }}

                        </div>

                    @endif

                    @if($errors->any())

                        <div class="alert alert-danger rounded-4">

                            {{ $errors->first() }}

                        </div>

                    @endif

                    <form method="POST"
                          action="{{ route('profile.update') }}"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="row g-4">

                            <!-- PHOTO -->

                            <div class="col-12">

                                <label class="form-label">

                                    Profile Photo

                                </label>

                                <input type="file"
                                       name="profile_photo"
                                       class="profile-input" style="cursor: pointer">

                            </div>

                            <!-- FIRST -->

                            <div class="col-md-4">

                                <label class="form-label">

                                    First Name

                                </label>

                                <input type="text"
                                       name="first_name"
                                       value="{{ auth()->user()->first_name }}"
                                       class="profile-input">

                            </div>

                            <!-- MIDDLE -->

                            <div class="col-md-4">

                                <label class="form-label">

                                    Middle Name

                                </label>

                                <input type="text"
                                       name="middle_name"
                                       value="{{ auth()->user()->middle_name }}"
                                       class="profile-input">

                            </div>

                            <!-- LAST -->

                            <div class="col-md-4">

                                <label class="form-label">

                                    Last Name

                                </label>

                                <input type="text"
                                       name="last_name"
                                       value="{{ auth()->user()->last_name }}"
                                       class="profile-input">

                            </div>

                            <!-- EMAIL -->

                            <div class="col-12">

                                <label class="form-label">

                                    Email Address

                                </label>

                                <input type="email"
                                       name="email"
                                       value="{{ auth()->user()->email }}"
                                       class="profile-input">

                            </div>
                            
                            <div class="col-12">

                                <label class="form-label">

                                    Bio

                                </label>

                                <textarea
                                    name="bio"
                                    rows="4"
                                    class="profile-input"
                                    placeholder="Tell something about yourself...">{{ auth()->user()->bio }}</textarea>

                            </div>
                        </div>

                        <!-- BUTTONS -->

                        <div class="d-flex gap-3 mt-5">

                            <button type="submit"
                                    class="profile-btn">

                                Save Changes

                            </button>

                            <button type="button"
                                    class="profile-btn secondary-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#passwordModal">

                                Change Password

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- PASSWORD MODAL -->

<div class="modal fade"
     id="passwordModal"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content custom-modal">

            <div class="modal-header">

                <h5 class="text-white fw-bold">

                    Change Password

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form method="POST"
                  action="{{ route('profile.password') }}">

                @csrf

                <div class="modal-body">

                    <div class="mb-4">

                        <label class="form-label">

                            Current Password

                        </label>

                        <input type="password"
                               name="current_password"
                               class="profile-input">

                    </div>

                    <div>

                        <label class="form-label">

                            New Password

                        </label>

                        <input type="password"
                               name="new_password"
                               class="profile-input">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="profile-btn secondary-btn"
                            data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit"
                            class="profile-btn">

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- PHOTO PREVIEW MODAL -->
<div class="modal fade" id="photoModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content bg-transparent border-0">

            <!-- X BUTTON -->
            <button
                type="button"
                class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                data-bs-dismiss="modal"
                style="z-index:999;">
            </button>

            <div class="modal-body text-center p-0">

                <img
                    src="{{ asset('storage/profile_photos/' . auth()->user()->profile_photo) }}"
                    class="img-fluid rounded-4 shadow-lg"
                    style="max-height:90vh;">

            </div>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection