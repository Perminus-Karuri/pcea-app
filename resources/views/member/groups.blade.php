@extends('layouts.member')

@section('content')

    <!-- JOIN GROUP -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5>Join a group</h5>

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
                                class="btn btn-warning w-100">Join group</button>
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

@endsection