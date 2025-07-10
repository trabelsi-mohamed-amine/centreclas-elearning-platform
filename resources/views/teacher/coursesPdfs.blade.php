<!-- Add Bootstrap CSS and Custom Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .custom-navbar {
        background: linear-gradient(135deg, #0061f2 0%, #00ba94 100%);
        padding: 1rem 0;
    }
    .custom-navbar .navbar-brand,
    .custom-navbar .nav-link {
        color: white !important;
    }
    .page-header {
        background: #f8f9fa;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-bottom: 1px solid #e9ecef;
    }
    .session-card {
        transition: transform 0.2s;
    }
    .session-card:hover {
        transform: translateY(-5px);
    }
    .table {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
        border-radius: 0.35rem;
        overflow: hidden;
    }
    .btn-group .btn {
        margin: 0 2px;
    }
    .modal-content {
        border: none;
        border-radius: 0.5rem;
    }
    .modal-header {
        background: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
</style>

<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <i class="fas fa-chalkboard-teacher me-2"></i>Teacher Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-envelope me-1"></i>Admin Messages
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container">
        <h1 class="display-4 text-center mb-2">Welcome to Your Teaching Portal</h1>
        <p class="lead text-center text-muted">Manage your sessions and course materials efficiently</p>
    </div>
</div>
<div class="container mt-4">
    <h2>Session PDFs</h2>

    @if($pdfs->isEmpty())
        <div class="alert alert-info">
            No PDFs uploaded yet for this session.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>PDF File</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pdfs as $index => $pdf)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ basename($pdf->pdf_file) }}</td>
                        <td>
                            <a href="{{ asset($pdf->pdf_file) }}" target="_blank">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    @endif
</div>
<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0">Your course pdf</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('courses.upload', ['session' => $sessionId]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="pdf_files" class="form-label">Upload Course PDFs</label>
                    <input class="form-control" type="file" id="pdf_files" name="pdf_files[]" multiple accept="application/pdf">
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-upload me-1"></i> Upload PDFs
                </button>
            </form>
        </div>
        
    </div>
</div>

<!-- Add Bootstrap JS and Font Awesome -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


