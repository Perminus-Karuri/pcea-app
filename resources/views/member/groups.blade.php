<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groups</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { overflow-x: hidden; }
        .sidebar { height: 100vh; }
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

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
        <a class="navbar-brand" href="#">PCEA Chaka Church</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('member.dashboard') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('member.zones') }}">Zones</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('member.groups') }}">Groups</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Contributions</a>
                </li>

                <li class="nav-item mx-4">
                    <a class="nav-link text-warning" href="{{ route('profile.edit') }}">
                        Profile
                    </a>
                </li>

                <li class="nav-item mx-4">
                    <a class="nav-link text-danger"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">

                        Logout
                    </a>

                    <form id="logout-form"
                          action="{{ route('logout') }}"
                          method="POST"
                          class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>


<div class="container py-4">

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif


    <!-- JOIN GROUP -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5>Join a Group</h5>

            <form method="POST"
                  action="{{ route('member.groups.join') }}">

                @csrf

                <div class="row g-2">

                    <div class="col-md-8">
                        <select name="group_id"
                                class="form-control"
                                required>

                            <option value="">Choose group</option>

                            @foreach($groups as $group)

                                @if(!$member->groups->contains($group->id))

                                    <option value="{{ $group->id }}">
                                        {{ $group->name }}
                                    </option>

                                @endif

                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4">
                        <button type="submit"
                                class="btn btn-warning w-100">

                            Join Group
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>


    <!-- MEMBER GROUPS -->
    @forelse($member->groups as $group)

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <!-- GROUP HEADER -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                    <div>
                        <h5>{{ $group->name }}</h5>
                        <p class="text-muted mb-0">
                            You are a member of this group
                        </p>
                    </div>

                    <!-- LEAVE GROUP -->
                    <form method="POST" action="{{ route('member.groups.leave', $group->id) }}">
                        @csrf

                        <button type="submit" class="btn btn-danger">
                            Leave group
                        </button>
                    </form>
                </div>

                <!-- GROUP MEMBERS -->
                <div>
                    <h6 class="mb-3">Group Members</h6>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($group->users as $groupMember)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $groupMember->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">
                                            No members in this group yet
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    @empty

        <div class="alert alert-secondary">
            You have not joined any groups yet.
        </div>

    @endforelse

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>