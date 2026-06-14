```blade
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
    .attendance-page{
        min-height:100vh;
        background:
        linear-gradient(
            135deg,
            #0f172a,
            #111827,
            #1e293b
        );

        padding:30px;
    }

    .attendance-wrapper{
        max-width:1200px;
        margin:auto;
    }

    .attendance-header{
        margin-bottom:30px;
    }

    .attendance-title{
        color:white;
        font-size:32px;
        font-weight:800;
        margin-bottom:5px;
    }

    .attendance-subtitle{
        color:#94a3b8;
        font-size:14px;
    }

    .maintenance-card{
        background:rgba(15,23,42,.72);
        border:1px solid rgba(255,255,255,.06);
        backdrop-filter:blur(14px);
        border-radius:28px;
        box-shadow:0 15px 35px rgba(0,0,0,.35);
        overflow:hidden;
        position:relative;
    }

    .maintenance-card::before{
        content:"";
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:4px;

        background:
        linear-gradient(
            90deg,
            #2563eb,
            #3b82f6,
            #60a5fa
        );
    }

    .maintenance-body{
        padding:60px 40px;
        text-align:center;
    }

    .maintenance-icon{
        width:140px;
        height:140px;

        margin:auto;

        border-radius:50%;

        display:flex;
        align-items:center;
        justify-content:center;

        background:
        linear-gradient(
            135deg,
            #2563eb,
            #3b82f6
        );

        box-shadow:
        0 0 35px rgba(59,130,246,.35);
    }

    .maintenance-icon i{
        font-size:60px;
        color:white;
    }

    .status-badge{

        display:inline-block;

        margin-top:25px;

        padding:8px 18px;

        border-radius:999px;

        background:
        linear-gradient(
            135deg,
            #2563eb,
            #3b82f6
        );

        color:white;

        font-size:12px;

        font-weight:600;

        letter-spacing:1px;
    }

    .maintenance-title{
        color:white;
        font-size:36px;
        font-weight:800;
        margin-top:25px;
        margin-bottom:15px;
    }

    .maintenance-text{
        color:#cbd5e1;
        max-width:750px;
        margin:auto;
        font-size:15px;
        line-height:1.8;
    }

    .feature-section{
        margin-top:50px;
    }

    .feature-card{
        background:rgba(255,255,255,.04);
        border:1px solid rgba(255,255,255,.05);
        border-radius:18px;
        padding:25px;
        height:100%;
        transition:.3s ease;
    }

    .feature-card:hover{
        transform:translateY(-5px);
        box-shadow:0 12px 25px rgba(0,0,0,.25);
    }

    .feature-icon{
        font-size:32px;
        color:#60a5fa;
        margin-bottom:15px;
    }

    .feature-title{
        color:white;
        font-weight:700;
        margin-bottom:10px;
    }

    .feature-text{
        color:#94a3b8;
        font-size:13px;
        line-height:1.7;
    }

    .notice-box{
        margin-top:40px;

        background:
        rgba(37,99,235,.12);

        border:
        1px solid rgba(59,130,246,.25);

        border-radius:18px;

        padding:18px;

        color:#cbd5e1;
    }

    .notice-box strong{
        color:#60a5fa;
    }

    .action-buttons{
        margin-top:35px;
    }

    .attendance-btn{
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

        text-decoration:none;

        transition:.3s ease;
    }

    .attendance-btn:hover{
        transform:translateY(-2px);
        box-shadow:0 12px 25px rgba(37,99,235,.30);
        color:white;
    }
    .maintenance-logo{
        width:160px;
        height:160px;
        object-fit:contain;
    }

    .maintenance-icon{
        width:140px;
        height:140px;

        margin:auto;

        border-radius:50%;

        display:flex;
        align-items:center;
        justify-content:center;

        background:rgba(255,255,255,.05);

        border:1px solid rgba(255,255,255,.08);

        backdrop-filter:blur(10px);

        box-shadow:
            0 0 35px rgba(59,130,246,.25);
    }
</style>

<div class="attendance-page">

    <div class="attendance-wrapper">

        <!-- Header -->

        <div class="attendance-header">

            <h1 class="attendance-title">
                Attendance
            </h1>

            <p class="attendance-subtitle">
                Monitor attendance records and attendance-related services.
            </p>

        </div>

        <!-- Main Card -->

        <div class="maintenance-card">

            <div class="maintenance-body">

                <div class="maintenance-icon">
                    <img src="{{ asset('ccs.png') }}"
                        alt="School Logo"
                        class="maintenance-logo">
                </div>

                <div class="status-badge">
                    SYSTEM MAINTENANCE
                </div>

                <h2 class="maintenance-title">
                    Attendance Module
                </h2>

                <p class="maintenance-text">
                    The Attendance Module is currently under development.
                    We are enhancing the system to provide attendance tracking,
                    attendance history, performance monitoring, attendance analytics,
                    and real-time notifications for students.
                </p>

                <!-- Feature Preview -->

                <div class="row feature-section g-4">

                    <div class="col-md-4">

                        <div class="feature-card">

                            <div class="feature-icon">
                                <i class="fas fa-user-check"></i>
                            </div>

                            <div class="feature-title">
                                Attendance Tracking
                            </div>

                            <div class="feature-text">
                                Monitor your attendance records and class participation history.
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="feature-card">

                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>

                            <div class="feature-title">
                                Attendance Analytics
                            </div>

                            <div class="feature-text">
                                View attendance statistics and monitor attendance performance.
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="feature-card">

                            <div class="feature-icon">
                                <i class="fas fa-bell"></i>
                            </div>

                            <div class="feature-title">
                                Notifications
                            </div>

                            <div class="feature-text">
                                Receive alerts regarding attendance status and updates.
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Notice -->

                <div class="notice-box">

                    <strong>Maintenance Notice:</strong>

                    This feature is temporarily unavailable while improvements
                    are being implemented. Please check back in a future update.

                </div>

                <!-- Button -->

                <div class="action-buttons">

                    <a href="{{ route('dashboard') }}"
                       class="attendance-btn">

                        <i class="fas fa-arrow-left me-2"></i>
                        Return to Dashboard

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection