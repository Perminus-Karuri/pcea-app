<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groups & Zones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { overflow-x: hidden; }
    .sidebar { height: 100vh; }
    .sidebar .nav-link { color: #adb5bd; }
    .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,0.1); border-radius: 8px; }
  </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="#">PCEA Chaka Church</a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Group/Zones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Announcements</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contributions</a></li>
                    <li class="nav-item mx-4">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">

        <!-- <h2 class="mb-4">My Zone</h2> -->

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>Select Your Zone</h5>

                <form method="POST" action="{{ route('member.zones.join') }}">
                    @csrf

                    <div class="row g-2">
                        <div class="col-md-8">
                            <select name="zone_id" class="form-control" required>
                                <option value="">Choose zone</option>
                                
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}"
                                        {{ $member->zone_id == $zone->id ? 'selected' : '' }}>
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-warning w-100">Join Zone</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>Current Zone</h5>

                @if($member->zone)
                    <p class="mb-0">
                        You belong to <strong>{{ $member->zone->name }}</strong> zone.
                    </p>
                @else
                    <p class="text-muted mb-0">
                        You have not joined any zone yet.
                    </p>
                @endif
            </div>
        </div>

        @if($member->zone)
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Other Members in {{ $member->zone->name }}</h5>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <!-- <th>Phone</th>
                                <th>Email</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($zoneMembers as $zoneMember)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $zoneMember->name }}</td>
                                    <!-- <td>{{ $zoneMember->phone }}</td>
                                    <td>{{ $zoneMember->email }}</td> -->
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        No other members in this zone yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif   

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>