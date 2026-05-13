<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('member.dashboard') }}">PCEA Chaka Church</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#memberNavbar" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="memberNavbar">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('member.dashboard') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('member.zones') }}">Zones</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('member.groups') }}">Groups</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Contributions</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-warning" href="{{ route('profile.edit') }}">
                        Profile
                    </a>
                </li>

                <li class="nav-item"> <a class="nav-link text-danger" href="{{ route('logout') }}"
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