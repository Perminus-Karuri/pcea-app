<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCEA Chaka Church</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand mx-4" href="#home">PCEA Chaka Church</a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-4"><a class="nav-link" id="home" href="#">Home</a></li>
                    <li class="nav-item mx-4"><a class="nav-link" href="#">Group/Zones</a></li>
                    <li class="nav-item mx-4"><a class="nav-link" href="#announcement">Announcements</a></li>
                    <li class="nav-item mx-4"><a class="nav-link" href="#">Contributions</a></li>
                    <li class="nav-item mx-4">
                        <a class="nav-link text-warning" href="{{ route('profile.edit') }}">Profile</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link text-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    <!-- <li class="nav-item"><a class="nav-link" href="registration.html"><span class="text-warning">Register</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html"><span class="text-warning">Login</span></a></li> -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-5 bg-dark text-white text-center">
        <h2 class="p-5">Welcome to <span class="text-warning">PCEA CHAKA CHURCH</span></h2>
        <p class="p-5">
            Welcome to PCEA Chaka Town Church. <br>
            We are delighted to have you here. <br>
            Whether you are visiting for the first time or you are part of our family,<br>
            may you find peace, hope and spiritual growth in our community.
        </p>
    </div>

    <div class="container-fluid p-5 bg-secondary text-black text-center">
        <div class="row align-items-center g-5">
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/Jesus is Lord.jpg') }}"
                     class="img-fluid rounded shadow"
                     style="max-height: 420px; width: auto;">
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <div class="text-center text-md-start w-100">
                    <h5>ABOUT US</h5>
                <p>
                    Our church is a place of worship, fellowship and transformation. <br>
                    We are committed to nurturing spiritual growth, <br>
                    building strong relationships and <br>
                    serving the community with love and compassion. <br>
                    Everyone is welcome to join us as we grow together in faith, love and hope.
                </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-5 bg-light text-black text-center" id="announcement">
        <h2>Announcements and Notices</h2>
        <div class="bg-secondary p-3 rounded mb-3">
            <h6 class="mb-2"><i>To All Members</i></h6>
            <p class="mb-0">All members are invited...</p>
        </div>

        <div class="bg-secondary p-3 rounded mb-3">
            <h6 class="mb-2"><i>To All Members</i></h6>
            <p class="mb-0">All members are invited...</p>
        </div>

        <div class="bg-secondary p-3 rounded mb-3">
            <h6 class="mb-2"><i>To All Members</i></h6>
            <p class="mb-0">All members are invited...</p>
        </div>

        <div class="bg-secondary p-3 rounded mb-3">
            <h6 class="mb-2"><i>To All Members</i></h6>
            <p class="mb-0">All members are invited...</p>
        </div>

    </div>

    <div class="container-fluid p-5 bg-dark text-white text-center">
        <div class="row">
            <div class="col text-white">
                <h5>OUR MISSION</h5>
                <p>
                    To be a great and dynamic godly model church for holistic service.
                </p>
            </div>
            <div class="col-sm bg-dark text-white">
                <h5>CONTACT US</h5>
                <p>
                    <span class="text-warning">Email</span>: pceachaka@gmail.com <br>
                    <span class="text-warning">Phone Number</span>: 0712345678
                </p>
            </div>
        </div>
    </div>

    <div class="mt-5 p-4 bg-secondary text-white text-center">
        <p>&copy; PCEA Chaka Church 2026</p>
        <small>Serving God, Serving people.</small>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>