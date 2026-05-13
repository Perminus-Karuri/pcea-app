@extends('layout.member')

@section('content')

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
        @forelse($announcements as $announcement)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h4 class="text-muted">
                        {{ $announcement->zone ? $announcement->zone->name . ' Zone' : 'All Members' }}
                    </h4>
                    
                    <h6>{{ $announcement->title }}</h6>

                    <p>{!! nl2br(e($announcement->message)) !!}</p>

                    <small class="text-muted">{{ $announcement->created_at->format('d M Y') }}</small>

                </div>
            </div>
        @empty
            <p class="text-muted">No announcements available.</p>
        @endforelse

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

@endsection