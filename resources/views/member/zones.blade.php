@extends('layouts.member')

@section('content')

    @if(!$member->zone_id)
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>Select Your Zone</h5>

                <form method="POST" action="{{ route('member.zones.join') }}">
                    @csrf

                    <div class="row g-2">
                        <div class="col-md-8">
                            <select name="zone_id" class="form-control" required>
                                <option value="">Choose zone</option>
                                
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}"
                                        {{ $member->zone_id == $zone->id ? 'selected' : '' }}>
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-warning w-100">Join Zone</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        @else
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>Current zone</h5>
                <p>You are a member of <strong>{{ $member->zone->name }}</strong></p>

                <form action="{{ route('member.zones.leave') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-danger">Leave zone</button>
                </form>
            </div>
        </div>
    @endif

    @if($member->zone)
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Other Members in {{ $member->zone->name }}</h5>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <!-- <th>Phone</th>
                                <th>Email</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($zoneMembers as $zoneMember)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $zoneMember->name }}</td>
                                    <!-- <td>{{ $zoneMember->phone }}</td>
                                    <td>{{ $zoneMember->email }}</td> -->
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        No other members in this zone yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
    @endif  
        
    @if($member->zone)
        <div class="card shadow-sm mt-4">
            <div class="card-body">
                <h5>{{$member->zone->name}} Zone Announcements</h5>

                @forelse($zoneAnnouncements as $announcement)
                <div class="border rounded p-3 mb-3">
                    <h6>{{$announcement->title}}</h6>
                    <p>{!! nl2br(e($announcement->message)) !!}</p>

                    <p class="text-muted">{{$announcement->created_at->format('d M Y')}}</p>
                </div>
                @empty
                <p class="text-muted">No announcement for your zone</p>
                @endforelse
            </div>
        </div>
    @endif

@endsection