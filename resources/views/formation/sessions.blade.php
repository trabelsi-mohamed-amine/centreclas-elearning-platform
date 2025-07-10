@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Les Sessions disponibles</h1>
                <a href="{{ route('student.formations.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back to Formations
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Date Debut</th>
                            <th>Date Fin</th>
                            <th>Formateur</th>
                            <th>Ressources</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td>{{ $session->title }}</td>
                            <td>{{ $session->description }}</td>
                            <td>{{ $session->start_time }}</td>
                            <td>{{ $session->end_time }}</td>
                            <td>
                                @if($session->teacher)
                                    <span class="badge bg-info text-dark">
                                        <i class="fas fa-user-tie"></i> {{ $session->teacher->name }}
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-exclamation-triangle"></i> Not Assigned
                                    </span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $enrollment = \App\Models\Enrollment::where('user_id', auth()->id())
                                        ->where('session_id', $session->id)
                                        ->first();
                                    $isEnrolledAndAccepted = $enrollment && $enrollment->status === 'accepted';
                                @endphp

                                <div class="btn-group">
                                    @if($session->timetable)
                                        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#timetableModal{{ $session->id }}">
                                            <i class="fas fa-calendar-alt me-1"></i> Emploi du temps
                                        </button>
                                    @endif
                                </div>

                                <!-- Timetable Modal -->
                                @if($session->timetable)
                                <div class="modal fade" id="timetableModal{{ $session->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-calendar me-2 text-info"></i>
                                                    Emploi du temps - {{ $session->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-3">
                                                    <div class="btn-group">
                                                        <a href="{{ route('sessions.view-timetable', $session->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-external-link-alt me-1"></i> Ouvrir dans un nouvel onglet
                                                        </a>
                                                        <a href="{{ route('sessions.download-timetable', $session->id) }}" class="btn btn-sm btn-outline-secondary">
                                                            <i class="fas fa-download me-1"></i> Télécharger
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="timetable-preview mt-3">
                                                    <img src="{{ route('sessions.view-timetable', $session->id) }}" class="img-fluid border rounded" alt="Aperçu de l'emploi du temps" style="max-height: 500px; margin: 0 auto; display: block;">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td>
                                @php
                                    $isEnrolled = \App\Models\Enrollment::where('user_id', auth()->id())
                                        ->where('session_id', $session->id)
                                        ->exists();
                                @endphp

                                @if ($isEnrolled)
                                    <form action="{{ route('sessions.cancel-enrollment', $session->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i> Annuler Participation
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('sessions.enroll', $session->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Participer
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }
    .badge {
        font-size: 0.9em;
        padding: 0.5em 0.7em;
    }
    .timetable-preview {
        text-align: center;
    }
    .btn-group .btn {
        margin: 0 2px;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
