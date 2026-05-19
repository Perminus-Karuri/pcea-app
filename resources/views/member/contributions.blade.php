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
                <input type="text"
                       name="phone"
                       class="form-control"
                       placeholder="2547XXXXXXXX"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Amount</label>
                <input type="number"
                       name="amount"
                       class="form-control"
                       placeholder="Enter amount"
                       min="1"
                       required>
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
                            <span class="badge bg-secondary">
                                {{ ucfirst($contribution->status) }}
                            </span>
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

@endsection