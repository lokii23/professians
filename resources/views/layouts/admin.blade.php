<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/pap1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #540001;
            color: white;
            padding: 20px;
        }

        .sidebar h4 {
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #ff005d;
            color: white;
        }

        .main {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            background: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .card-modern {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .card-modern:hover {
            transform: translateY(-5px);
        }

        .table-modern {
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }
        .menu-item {
            display: block;
            padding: 10px 15px;
            color: #ccc;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        /* Hover */
        .menu-item:hover {
            background: #1f2a44;
            color: #fff;
        }

        /* ACTIVE STATE */
        .menu-item.active {
            background: linear-gradient(135deg, #ff005d, #ff005d);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4>⚙ Admin</h4>

    <a href="{{ route('admin.dashboard') }}" 
    class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        📊 Dashboard
    </a>
    <a href="{{ route('admin.exams') }}" 
    class="menu-item {{ request()->routeIs('admin.exams') ? 'active' : '' }}">
        📚 Exams
    </a>
    <a href="{{ route('admin.sections') }}" 
    class="menu-item {{ request()->routeIs('admin.sections') ? 'active' : '' }}">
        👨‍🎓 Students
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger w-100 mt-3">Logout</button>
    </form>
</div>

<div class="main">

    <div class="topbar d-flex justify-content-between">
        <h5>Admin Dashboard</h5>
        <strong>{{ now()->format('F d, Y') }}</strong>
    </div>

    @yield('content')

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>