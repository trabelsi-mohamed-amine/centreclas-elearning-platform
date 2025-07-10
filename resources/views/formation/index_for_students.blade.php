
@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h3 mb-0 text-gray-800"> les Formations disponibles</h1>
                </div>
                <div class="col">
                    <form method="GET" action="{{ route('student.formations.index') }}" class="mb-0">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Saisir nom de formations..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Rechercher
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Durée</th>
                            <th>Prix(DT)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formations as $item)
                        @php
                            $isEnrolled = \App\Models\Enrollment::where('user_id', auth()->id())
                            ->where('formation_id', $item->id)
                            ->exists();
                        @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href="{{ route('student.formations.sessions', $item->id) }}" class="text-primary text-decoration-none">
                                        {{ $item->name }}
                                    </a>
                                </td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->duration }} hours</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>
                                    @if ($isEnrolled)
                                    <form action="{{ route('sessions.cancel-enrollment', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i> Annuller participation
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('sessions.enroll', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> participer
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
@endsection
