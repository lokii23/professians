<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>PROFESSIANS | Student Dashboard</title>

    <link rel="icon" href="/pap1.png">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">
    
<style>

body{
    margin:0;
    font-family:'Poppins',sans-serif;

    background:
    linear-gradient(
        135deg,
        #eef2ff,
        #f8fafc
    );

    overflow-x:hidden;
}

/* TOGGLE */

.hide-sidebar-btn{
    position:fixed;
    top:18px;
    left:18px;
    z-index:2000;

    width:44px;
    height:44px;

    border:none;
    border-radius:14px;

    background:#0f172a;
    color:white;

    font-size:18px;
    cursor:pointer;

    transition:.3s ease;

    box-shadow:0 8px 20px rgba(0,0,0,.15);
}

.hide-sidebar-btn:hover{
    transform:scale(1.05);
}

/* SIDEBAR */

.sidebar{
    width:250px;
    height:100vh;

    position:fixed;
    top:0;
    left:0;

    padding:24px 18px;

    background:rgba(15,23,42,.96);

    backdrop-filter:blur(20px);

    color:white;

    display:flex;
    flex-direction:column;

    transition:.35s ease;

    z-index:1000;

    border-right:1px solid rgba(255,255,255,.06);

    box-shadow:8px 0 30px rgba(0,0,0,.08);
}

/* COLLAPSE */

.sidebar.collapsed{
    transform:translateX(-88%);
}

/* PROFILE */

.sidebar-profile-image{
    width:85px;
    height:85px;

    border-radius:50%;
    object-fit:cover;

    border:3px solid rgba(255,255,255,.12);

    box-shadow:0 0 25px rgba(59,130,246,.35);
}

.sidebar-profile-placeholder{
    width:85px;
    height:85px;

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

    font-size:32px;
    font-weight:700;

    color:white;

    margin:auto;

    box-shadow:0 0 25px rgba(59,130,246,.30);
}

/* NAME */

.sidebar h5{
    font-size:18px;
}

/* DIVIDER */

.sidebar hr{
    border-color:rgba(255,255,255,.08);
}

/* MENU */

.menu-links{
    margin-top:8px;
}

.menu-links a{
    display:flex;
    align-items:center;
    gap:12px;

    padding:13px 16px;

    color:#cbd5e1;

    text-decoration:none;

    border-radius:14px;

    margin-bottom:10px;

    font-size:15px;
    font-weight:600;

    transition:.25s ease;
}

.menu-links a:hover{
    background:rgba(255,255,255,.08);

    color:white;

    transform:translateX(5px);
}

/* ACTIVE */

.active-link{
    background:
    linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );

    color:white !important;

    box-shadow:0 10px 25px rgba(37,99,235,.30);
}

/* LOGOUT */

.logout-btn{
    border:none;

    border-radius:14px;

    padding:13px;

    font-weight:600;

    background:#ef4444;

    color:white;

    transition:.3s ease;
}

.logout-btn:hover{
    background:#dc2626;

    transform:translateY(-2px);
}

/* MAIN */

.main{
    margin-left:250px;

    padding:24px;

    transition:.35s ease;
}

.main.full{
    margin-left:35px;
}

/* TOPBAR */

.topbar{
    background:white;

    padding:22px 26px;

    border-radius:22px;

    margin-bottom:24px;

    border:1px solid #e2e8f0;

    box-shadow:0 10px 25px rgba(0,0,0,.04);
}

.topbar h4{
    color:#0f172a;
}

.topbar small{
    color:#64748b;
}

/* CARDS */

.card-modern{
    background:white;

    border-radius:20px;

    padding:20px;

    border:1px solid #e2e8f0;

    box-shadow:0 10px 30px rgba(0,0,0,.04);

    transition:.3s ease;
}

.card-modern:hover{
    transform:translateY(-4px);
}

/* EXAM */

.exam-card{
    border:none;

    border-radius:20px;

    padding:18px;

    background:white;

    box-shadow:0 8px 25px rgba(0,0,0,.05);

    transition:.3s ease;
}

.exam-card:hover{
    transform:translateY(-5px);
}

/* BUTTON */

.take-btn{
    background:
    linear-gradient(
        135deg,
        #2563eb,
        #3b82f6
    );

    color:white;

    border:none;

    border-radius:12px;

    padding:10px;

    font-size:14px;
    font-weight:600;

    transition:.3s ease;
}

.take-btn:hover{
    color:white;

    transform:translateY(-2px);

    box-shadow:0 10px 20px rgba(37,99,235,.25);
}

/* MOBILE */

@media(max-width:768px){

    .sidebar{
        width:230px;
    }

    .main{
        margin-left:15px;
    }

    .topbar{
        padding:18px;
    }

}

</style>x

</head>

<body>

<!-- TOGGLE BUTTON -->

<button id="hideSidebarBtn"
        class="hide-sidebar-btn">

    ☰

</button>

<!-- SIDEBAR -->

<div class="sidebar"
     id="sidebar">

    <div class="text-center mb-4">

        @if(auth()->user()->profile_photo)

            <img src="{{ asset('storage/profile_photos/' . auth()->user()->profile_photo) }}"
                 class="sidebar-profile-image">

        @else

            <div class="sidebar-profile-placeholder">

                {{ strtoupper(substr(auth()->user()->first_name,0,1)) }}

            </div>

        @endif

        <h5 class="text-white mt-3 fw-bold">

            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}

        </h5>
        <div style="color:#94a3b8; font-size:12px; line-height:1.5;">

            {{ Str::limit(auth()->user()->bio, 60) }}

        </div>
    </div>
    
        <hr>
    <!-- MENU -->

    <div class="menu-links">
        <a href="/dashboard"
           class="{{ request()->is('dashboard') ? 'active-link' : '' }}">

            🏠 Dashboard

        </a>

        <a href="{{ route('student.result') }}"
           class="{{ request()->routeIs('student.result*') ? 'active-link' : '' }}">

            📊 Results

        </a>
        

        <a href="{{ route('profile.index') }}"
           class="{{ request()->routeIs('profile.*') ? 'active-link' : '' }}">

            👤 My Account

        </a>
        <a href="{{ route('student.attendance') }}"
        class="{{ request()->routeIs('student.attendance') ? 'active-link' : '' }}">

            📅 Attendance

        </a>
        <a href="{{ route('student.faculty') }}"
        class="{{ request()->routeIs('student.faculty') ? 'active-link' : '' }}">

            👨‍🏫 CCS Faculty

        </a>
    </div>

    <!-- LOGOUT -->

    <div style="margin-top:auto;">

        <form method="POST"
              action="{{ route('logout') }}">

            @csrf

            <button class="logout-btn w-100">

                Logout 🚪

            </button>

        </form>

    </div>

</div>

<!-- MAIN CONTENT -->

<div class="main"
     id="mainContent">

    <!-- TOPBAR -->

    <div class="topbar d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h4 class="fw-bold mb-1">

                Welcome, {{ Auth::user()->first_name }}!

            </h4>

            <small>

                Ready to take your exams?

            </small>

        </div>

        <div class="mt-2 mt-md-0">

            <strong>

                {{ now()->format('F d, Y') }}

            </strong>

        </div>

    </div>

    @yield('content')

</div>

<script>

    const sidebar =
    document.getElementById('sidebar');

    const button =
    document.getElementById('hideSidebarBtn');

    const main =
    document.getElementById('mainContent');

    button.addEventListener('click', ()=>{

        sidebar.classList.toggle('collapsed');

        main.classList.toggle('full');

    });

</script>

</body>

</html>