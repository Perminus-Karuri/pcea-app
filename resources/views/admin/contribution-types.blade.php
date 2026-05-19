@extends('layouts.admin')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <h2 class="mb-4">Contribution Types</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-3">Add Contribution Type</h5>

            <form method="POST" action="{{ route('admin.contribution-types.store') }}">
                @csrf

                <div class="row g-2">
                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" placeholder="e.g. Tithe, Offering, Thanksgiving" required>
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-warning w-100">
                            Add Type
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">All Contribution Types</h5>

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Contribution Type</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($types as $type)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $type->name }}</td>
                            <td class="text-end">
                                <form method="POST" action="{{ route('admin.contribution-types.delete', $type->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection