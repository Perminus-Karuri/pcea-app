@extends('layouts.member')

@section('content')

<h2 class="mb-4">My Contributions</h2>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3">Make a Contribution</h5>

        <form method="POST" action="{{ route('member.contributions.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Contribution Type</label>
                <select name="contribution_type_id" class="form-control" required>
                    <option value="">Select contribution type</option>

                    @foreach($types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text"  name="phone" class="form-control"  value="{{ old('phone', auth()->user()->phone) }}" placeholder="07XXXXXXXX" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Amount</label>
                <input type="number" name="amount" class="form-control" placeholder="Enter amount" min="1" required>
            </div>

            <button type="submit" class="btn btn-success">
                Pay with M-Pesa
            </button>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Contribution History</h5>

        <!-- filter form -->
        <form method="GET" action="{{ route('member.contributions') }}" class="row g-3 mb-4">

            <!-- Contribution Type -->
            <div class="col-md-3">
                <label class="form-label">Contribution Type</label>

                <select name="type" class="form-select">
                    <option value="">All Types</option>

                    @foreach($types as $type)
                        <option value="{{ $type->id }}"
                            {{ request('type') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="col-md-2">
                <label class="form-label">Status</label>

                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="successful" {{ request('status') == 'successful' ? 'selected' : '' }}>Successful</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>

            <!-- From Date -->
            <div class="col-md-2">
                <label class="form-label">From</label>
                <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>

            <!-- To Date -->
            <div class="col-md-2">
                <label class="form-label">To</label>
                <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button class="btn btn-warning">
                    Filter
                </button>

                <a href="{{ route('member.contributions') }}" class="btn btn-secondary">
                    Reset
                </a>
            </div>

        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
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
                            <td>{{ $contribution->contributionType->name }}</td>
                            <td>{{ $contribution->phone }}</td>
                            <td>KES {{ number_format($contribution->amount, 2) }}</td>
                            <td>
                                @if($contribution->status == 'successful')
                                    <span class="text-success">Successful</span>

                                @elseif($contribution->status == 'failed')
                                    <span class="text-danger">Failed</span>

                                @else
                                    <span class="text-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $contribution->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No contributions made yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection