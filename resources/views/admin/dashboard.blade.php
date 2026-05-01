<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { overflow-x: hidden; }
    .sidebar { height: 100vh; }
    .sidebar .nav-link { color: #adb5bd; }
    .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,0.1); border-radius: 8px; }
  </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar py-4">
                <div class="text-center text-white mb-4">
                    <h4>PCEA CHAKA CHURCH</h4>
                    <small>Admin Panel</small>
                </div>

                <ul class="nav flex-column px-3">
                    <li class="nav-item mb-2">
                        <a class="nav-link active text-white" href="#">Members</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="#">Contributions</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('admin.announcements') ? 'active' : '' }}"
                            href="{{ route('admin.announcements') }}">
                                Announcements
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('admin.zones') }}">Zones</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="#">Groups</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-warning" href="{{ route('profile.edit') }}">Profile</a>
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
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Dashboard</h2>
                    <button class="btn btn-primary">+ Add Announcement</button>
                </div>

                <!-- STATS -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted">Total Members</h6>
                                <h3>{{ $totalMembers }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted">Total Contributions</h6>
                                <h3>KES 50,000</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted">Active Groups</h6>
                                <h3>8</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="mb-3">Church Members</h5>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->phone }}</td>
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
</body>
</html>
