@extends('layouts.admin')

@section('content')

    <!-- MAIN CONTENT -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <div class="container-fluid d-md-none mb-3">
          <button class="btn btn-dark" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu">
                ☰ Menu
          </button>
        </div>


        <!-- TOP BAR -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2>Church Announcements</h2>
          <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal">+ Add Announcement</button>
        </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.announcements.store') }}">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">Add Announcement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Target Zone</label>
                                <select name="zone_id" class="form-control">
                                    <option value="">All Members</option>

                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}">
                                            {{ $zone->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input name="title" class="form-control" type="text" placeholder="e.g. District fellowship" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control" rows="5" placeholder="Enter your message here..." required></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                + Add
                            </button>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
                

        <!-- TABLE -->
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h3 class="mb-3">Posted Announcements</h3>
            @foreach($announcements as $announcement)
                <div class="border rounded p-3 mb-3 bg-light">
                    <small class="text-muted">
                        Target:
                        {{ $announcement->zone ? $announcement->zone->name . ' Zone' : 'All Members' }}
                    </small>

                    <h6><i>{{ $announcement->title }}</i></h6>

                    <!-- multi-line message -->
                    <p>{!! nl2br(e($announcement->message)) !!}</p> 

                    <small class="text-muted">
                        Posted on {{ $announcement->created_at->format('d M Y') }}
                    </small>

                    <div class="mt-3 d-flex gap-2">
                        <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $announcement->id }}">
                            Edit
                        </button>

                        <form method="POST" action="{{ route('admin.announcements.delete', $announcement->id) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $announcement->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form method="POST" action="{{ route('admin.announcements.update', $announcement->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Announcement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text"
                                            name="title"
                                            class="form-control"
                                            value="{{ $announcement->title }}"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Message</label>
                                        <textarea name="message"
                                                class="form-control"
                                                rows="5"
                                                required>{{ $announcement->message }}</textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">
                                        Save Changes
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
          </div>
        </div>

    </main>
@endsection
