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
                <li>
                    <a class="nav-link {{ request()->routeIs('admin.contribution-types') ? 'active' : '' }}"
                        href="{{ route('admin.contribution-types') }}">
                            Contribution Types
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('admin.contributions') }}">Contributions</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ request()->routeIs('admin.announcements') ? 'active' : '' }}"
                        href="{{ route('admin.announcements') }}">
                        Announcements
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('admin.zones') }}">Zones</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('admin.groups') }}">Groups</a>
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