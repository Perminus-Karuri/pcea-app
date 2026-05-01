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

        <!-- SIDEBAR -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar py-4">
            <div class="text-center text-white mb-4">
                <h5>PCEA CHAKA</h5>
                <small>Admin Panel</small>
            </div>

            <ul class="nav flex-column px-3">
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Members</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="#">Contributions</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="#">Announcements</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link active" href="#">Zones</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="#">Groups</a>
                </li>

                <li class="nav-item mb-2">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </li>
            </ul>
        </nav>

        <!-- MAIN CONTENT -->
        <main class="col-md-9 col-lg-10 px-md-4 py-4">

            <!-- PAGE TITLE -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Zones</h2>
            </div>

            <!-- ADD ZONE -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Add New Zone</h5>

                    <form method="POST" action="{{ route('admin.zones.store') }}">
                        @csrf

                        <div class="row g-2">
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" placeholder="Enter zone name" required>
                            </div>

                            <div class="col-md-4">
                                <button class="btn btn-warning w-100" type="submit">
                                    Add Zone
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- ZONES TABLE -->
            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="mb-3">All Zones</h5>

                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Zone Name</th>
                                <th>Zone Members</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($zones as $zone)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $zone->name }}</td>
                                <td>{{ $zone->users_count }}</td>
                                <td class="text-end">
                                
                                    <form action="{{ route('admin.zones.delete', $zone->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                <h5 class="mb-3">Zone Members</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone no.</th>
                            <th>Zone</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->zone?->name ?? 'No Zone '}}</td>
                            <td>{{ $member->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>

        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
