@extends('layouts.admin')

@section('content')

<main class="col-md-9 col-lg-10 px-md-4 py-4">

    <h2 class="mb-4">Contributions</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="text-muted">Total Successful Contributions</h6>
            <h3>KES {{ number_format($totalAmount, 2) }}</h3>
        </div>
        <div class="card-body">
            <h6 class="text-muted">Total Failed Contributions</h6>
            <h3>KES {{ number_format($totalFailedAmount, 2) }}</h3>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-3">Filter Contributions</h5>

            <form method="GET" action="{{ route('admin.contributions') }}">
                <div class="row g-2">
                    <div class="col-md-4">
                        <label for="type" class="form-label">Contribution Type</label>
                        <select name="type" class="form-control">
                            <option value="">All Contribution Types</option>

                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="from_date" class="form-label">From Date</label>
                        <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From date" value="{{ request('from_date') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="to_date" class="form-label">To Date</label>
                        <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To date" value="{{ request('to_date') }}">
                    </div>

                    <div class="col-md-1">
                        <label for="filter" class="form-label">&nbsp;</label>
                        <button class="btn btn-warning w-100">
                            Filter
                        </button>
                    </div>

                    <div class="col-md-1">
                        <label for="reset" class="form-label">&nbsp;</label>
                        <button href="{{ route('admin.contributions') }}" class="btn btn-secondary">
                            Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">All Contributions</h5>

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Member</th>
                        <th>Type</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($contributions as $contribution)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contribution->user->name }}</td>
                            <td>{{ $contribution->contributionType->name }}</td>
                            <td>{{ $contribution->phone }}</td>
                            <td>KES {{ number_format($contribution->amount, 2) }}</td>
                            <td>{{ ucfirst($contribution->status) }}</td>
                            <td>{{ $contribution->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                No contributions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</main>

@endsection