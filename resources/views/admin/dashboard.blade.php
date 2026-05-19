@extends('layouts.admin')

@section('content')
<!-- MAIN CONTENT -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
    </div>

    <!-- STATS -->
    <div class="container g-4 mb-4">
                    <div class="">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-center">Total Members</h6>
                                <h3 class="text-center">{{ $totalMembers }}</h3>
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
@endsection
