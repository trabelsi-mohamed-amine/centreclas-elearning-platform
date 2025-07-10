@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(auth()->user()->role_id === 1)
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Sessions Management</h1>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary me-2">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            <a href="{{ route('sessions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
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
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td class="fw-medium">{{ $session->title }}</td>
                            <td>{{ Str::limit($session->description, 50) }}</td>
                            <td>{{ \Carbon\Carbon::parse($session->start_time)->format('M d, Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($session->end_time)->format('M d, Y H:i') }}</td>
                            <td>
                                @if($session->teacher)
                                    <span class="badge bg-info text-dark">{{ $session->teacher->name }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">Not Assigned</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('sessions.edit', $session->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this session?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> You do not have permission to view this page.
        </div>
    @endif
</div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .table th, .table td { vertical-align: middle; }
    .btn { transition: all 0.2s; }
    .card { border-radius: 10px; }
    .badge { font-weight: 500; }
</style>
@endsection
