<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zones - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
        }

        .sidebar .nav-link {
            color: #adb5bd;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- NAVBAR -->
         @include('partials.admin-sidebar')

        <!-- MAIN CONTENT -->
        @yield('content')

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
