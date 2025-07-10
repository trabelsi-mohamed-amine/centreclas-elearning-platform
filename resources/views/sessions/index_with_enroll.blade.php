@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">Available Sessions</h1>
                <a href="{{ route('student.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>

        <div class="card-body">
            @if($sessions->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <p class="h5 text-muted">No sessions are currently available</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Schedule</th>
                                <th>Teacher</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $session)
                            <tr>
                                <td class="fw-medium">{{ $session->title }}</td>
                                <td>{{ Str::limit($session->description, 100) }}</td>
                                <td>
                                    <div class="small">
                                        <div class="mb-1">
                                            <i class="fas fa-calendar-alt text-primary"></i>
                                            {{ \Carbon\Carbon::parse($session->start_time)->format('M d, Y') }}
                                        </div>
                                        <div>
                                            <i class="fas fa-clock text-primary"></i>
                                            {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($session->teacher)
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                                 style="width: 32px; height: 32px">
                                                {{ strtoupper(substr($session->teacher->name, 0, 1)) }}
                                            </div>
                                            {{ $session->teacher->name }}
                                        </div>
                                    @else
                                        <span class="badge bg-warning text-dark">Not Assigned</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @php
                                        $isEnrolled = \App\Models\Enrollment::where('user_id', auth()->id())
                                            ->where('session_id', $session->id)
                                            ->exists();
                                    @endphp

                                    @if($isEnrolled)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle"></i> Enrolled
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-hourglass-half"></i> Not Enrolled
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        @if($isEnrolled)
                                            <form action="{{ route('sessions.cancel-enrollment', $session->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to cancel your enrollment?')">
                                                    <i class="fas fa-times"></i> Annuler
                                                </button>
                                            </form>
                                            @if($session->course)
                                                <a href="{{ asset('storage/' . $session->course) }}"
                                                   class="btn btn-outline-primary btn-sm" target="_blank">
                                                    <i class="fas fa-file-pdf"></i> Voir Cours
                                                </a>
                                            @endif
                                        @else
                                            <form action="{{ route('sessions.enroll', $session->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-user-plus"></i> participer
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .card { border-radius: 10px; }
    .btn { border-radius: 7px; transition: all 0.2s; }
    .btn:hover { transform: translateY(-1px); }
    .badge { font-weight: 500; padding: 0.5em 0.7em; }
    .table-hover tbody tr:hover { background-color: rgba(0,0,0,.02); }
</style>
@endsection
