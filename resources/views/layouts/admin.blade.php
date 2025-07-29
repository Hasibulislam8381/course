<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        .wrapper {
            display: flex;
            flex: 1;
            min-height: 100vh;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            transition: all 0.3s;
        }
        .sidebar a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        @media (max-width: 992px) {
            .sidebar {
                position: fixed;
                left: -250px;
                top: 0;
                width: 250px;
                height: 100%;
                z-index: 1030;
            }
            .sidebar.show {
                left: 0;
            }
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 1020;
                display: none;
            }
            .overlay.show {
                display: block;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
<nav class="navbar navbar-dark bg-dark d-lg-none">
    <div class="container-fluid">
        <button class="btn btn-outline-light" id="sidebarToggle">
            ☰ Menu
        </button>
        <span class="navbar-brand mb-0 h1">Admin Panel</span>
    </div>
</nav>

<div class="wrapper">
    <nav class="sidebar" id="sidebar">
        <h4 class="p-3 border-bottom">Admin Panel</h4>
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            View
        </a>
        <a href="{{ route('courses.create') }}" class="{{ request()->routeIs('courses.create') ? 'active' : '' }}">
            Create Course
        </a>
    </nav>

    <div class="overlay" id="overlay"></div>

    <main class="content">
        @yield('content')
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const toggleBtn = document.getElementById('sidebarToggle');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
