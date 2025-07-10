@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Modifier une Session</h3>

                </div>
                <div class="card-body">
                    <form action="{{ route('sessions.update', $session->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ $session->title }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4">{{ $session->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="start_time" class="form-label">Date Debut<span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror"
                                       id="start_time" name="start_time"
                                       value="{{ date('Y-m-d\TH:i', strtotime($session->start_time)) }}" required>
                                @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_time" class="form-label">Date Fin<span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror"
                                       id="end_time" name="end_time"
                                       value="{{ date('Y-m-d\TH:i', strtotime($session->end_time)) }}" required>
                                @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="formation_id" class="form-label">Formation <span class="text-danger">*</span></label>
                                <select class="form-select @error('formation_id') is-invalid @enderror"
                                        id="formation_id" name="formation_id" required>
                                    <option value="" disabled>Selectionner une formations</option>
                                    @foreach($formations as $formation)
                                        <option value="{{ $formation->id }}"
                                                {{ $session->formation_id == $formation->id ? 'selected' : '' }}>
                                            {{ $formation->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('formation_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="teacher_id" class="form-label">Formateur</label>
                                <select class="form-select @error('teacher_id') is-invalid @enderror"
                                        id="teacher_id" name="teacher_id">
                                    <option value="" disabled>Selectionner un formateur</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                                {{ $session->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                     
                        

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('formation.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .card { border-radius: 10px; }
    .card-header { border-radius: 10px 10px 0 0 !important; }
    .form-control, .form-select { border-radius: 7px; }
    .btn { border-radius: 7px; transition: all 0.2s; }
    .badge { font-size: 0.9em; }
</style>
@endsection

@section('scripts')
<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()

    // Date validation
    document.getElementById('end_time').addEventListener('change', function() {
        const startTime = new Date(document.getElementById('start_time').value);
        const endTime = new Date(this.value);

        if (endTime <= startTime) {
            this.setCustomValidity('End time must be after start time');
        } else {
            this.setCustomValidity('');
        }
    });
</script>
@endsection
