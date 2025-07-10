<!-- Add Bootstrap CSS and other dependencies -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    .custom-card {
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .custom-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    .nav-pills .nav-link {
        border-radius: 20px;
        padding: 10px 20px;
        margin: 0 5px;
        color: #6c757d;
        font-weight: 500;
    }
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        color: white;
    }
    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }
    .btn-custom {
        border-radius: 20px;
        padding: 8px 15px;
        font-weight: 500;
    }
    .btn-custom:hover {
        background-color: #e9ecef;
    }
    .status-badge {
        padding: 5px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .custom-navbar {
        background: linear-gradient(to right, #eb69d7, #9b4eb0 100%);
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
    }
    .session-card:hover {
        background-color: #f8f9fa;
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
        background: #ffffff;
        border-bottom: 1px solid #ffffff;
    }
    .custom-purple {
        color: #ac42c1 !important;
    }
    .custom-purple:hover {
        color: #9b4eb0 !important;
    }
    .file-list {
        max-height: 300px;
        overflow-y: auto;
    }
    .file-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .file-item:hover {
        background-color: #f5f5f5;
    }
    .file-item .file-name {
        flex-grow: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: 0 10px;
    }
    .file-actions {
        display: flex;
        gap: 5px;
    }
    .file-preview-container {
        padding: 15px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-top: 15px;
        max-height: 400px;
        overflow: auto;
    }
    .preview-iframe {
        width: 100%;
        height: 400px;
        border: none;
    }
    .timetable-preview {
        text-align: center;
    }
    .btn-sm {
        height: 31px;
    }
    * {
        -webkit-transition: none !important;
        -moz-transition: none !important;
        -o-transition: none !important;
        transition: none !important;
        -webkit-transform: none !important;
        -moz-transform: none !important;
        -o-transform: none !important;
        transform: none !important;
        animation: none !important;
    }
</style>
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <i class="fas fa-chalkboard-teacher me-2"></i>Apprenant
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Lien Accueil vers teacher-interface -->
                <li class="nav-item">
                    <a class="nav-link text-dark {{ Request::is('student-interface') ? 'active-link' : '' }}" href="{{ url('/student-interface') }}">
                        <i class="fas fa-home me-2"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('chatbot.show') }}" class="nav-link {{ Request::is('chat') ? 'active-link' : '' }}">
                        <i class="fas fa-robot me-1"></i> ChatBot Assistant
                    </a>
                </li>

                <!-- Lien Paramètres du Compte -->
                <li class="nav-item">
                    <a class="nav-link text-dark {{ Request::is('account-settings') ? 'active-link' : '' }}" href="{{ url('/account-settings') }}">
                        <i class="fas fa-cogs me-2"></i> Paramètres du Profil
                    </a>
                </li>

                <!-- Lien Déconnexion -->
                <li class="nav-item">
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" onclick="confirmLogout(event);" class="nav-link text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="custom-card bg-white p-4 mb-4">
                    <h1 class="text-center mb-3" style="color: #2c3e50;">Bienvenue sur notre plateforme de formation !</h1>
                    <p class="text-center text-muted mb-4">Nous sommes ravis de vous compter parmi nos apprenants. Vous allez découvrir un espace pensé pour vous accompagner tout au long de votre parcours d’apprentissage, avec des contenus riches, des outils interactifs et le soutien de nos formateurs. N’hésitez pas à explorer, poser vos questions et tirer le meilleur de cette expérience. Bonne formation à vous, cher apprenant !
                    </p>

                    <nav class="mb-5">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link custom-purple" href="{{ route('student.formations.index') }}">
                                    <i class="fas fa-graduation-cap me-2"></i> les Formations
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-envelope me-2"></i>Message
                                </a>
                            </li>
                        </ul>
                    </nav>

                    @php
                        $enrollments = \App\Models\Enrollment::where('user_id', auth()->id())->with('session.teacher')->get();
                    @endphp

                    <div class="custom-card bg-white p-4">
                        <h2 class="mb-4" style="color: #2c3e50;"><i class="fas fa-book-reader me-2"></i>Vos Sessions</h2>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Schedule</th>
                                        <th>Formateur</th>
                                        <th>Materials</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enrollments as $enrollment)
                                        <tr>
                                            <td class="align-middle">
                                                <strong>{{ $enrollment->session ? $enrollment->session->title : 'Pending Assignment' }}</strong>
                                            </td>
                                            <td class="align-middle">
                                                <small class="text-muted">{{ $enrollment->session ? Str::limit($enrollment->session->description, 100) : 'Waiting for session assignment' }}</small>
                                            </td>
                                            <td class="align-middle">
                                                @if($enrollment->session)
                                                <div class="d-flex flex-column">
                                                    <small class="text-success">
                                                        <i class="far fa-clock me-1"></i>
                                                        Start: {{ \Carbon\Carbon::parse($enrollment->session->start_time)->format('M d, Y H:i') }}
                                                    </small>
                                                    <small class="text-danger">
                                                        <i class="far fa-clock me-1"></i>
                                                        End: {{ \Carbon\Carbon::parse($enrollment->session->end_time)->format('M d, Y H:i') }}
                                                    </small>
                                                </div>
                                                @else
                                                <span class="badge bg-secondary">Schedule not yet available</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user-tie me-2 text-primary"></i>
                                                    {{ $enrollment->session && $enrollment->session->teacher ? $enrollment->session->teacher->name : 'Not Assigned' }}
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                @if($enrollment->status === 'accepted' && $enrollment->session)
                                                    <div class="d-flex gap-2">
                                                        <!-- Course Files Button -->
                                                        <button type="button" class="btn btn-custom btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#coursesModal{{ $enrollment->session->id }}">
                                                            <i class="fas fa-book me-1"></i> Les Cours
                                                        </button>

                                                        <!-- Timetable Button -->
                                                        @if($enrollment->session->timetable)
                                                            <button type="button" class="btn btn-custom btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#timetableModal{{ $enrollment->session->id }}">
                                                                <i class="fas fa-calendar-alt me-1"></i> Schedule
                                                            </button>
                                                        @endif
                                                    </div>

                                                    <!-- Course Files Modal -->
                                                    <div class="modal fade" id="coursesModal{{ $enrollment->session->id }}" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        <i class="fas fa-book me-2 text-success"></i>
                                                                        Course Files - {{ $enrollment->session->title }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Legacy course file support -->
                                                                    @if($enrollment->session->course)
                                                                        <div class="alert alert-info">
                                                                            <div class="d-flex justify-content-between align-items-center">
                                                                                <div>
                                                                                    <i class="fas fa-file-pdf me-2"></i>
                                                                                    <strong>Course File:</strong> {{ basename($enrollment->session->course) }}
                                                                                </div>
                                                                                <div class="btn-group">
                                                                                    <a href="{{ route('sessions.download-course', $enrollment->session->id) }}" class="btn btn-sm btn-outline-primary">
                                                                                        <i class="fas fa-download me-1"></i> Télécharger
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    <!-- New multiple course files -->
                                                                    <div class="file-list" id="fileList{{ $enrollment->session->id }}">
                                                                        <!-- Files will be loaded here via JavaScript -->
                                                                        <div class="text-center py-3" id="fileListLoader{{ $enrollment->session->id }}">
                                                                            <div class="spinner-border spinner-border-sm text-primary me-2" role="status">
                                                                                <span class="visually-hidden">Chargement...</span>
                                                                            </div>
                                                                            Chargement des fichiers...
                                                                        </div>
                                                                        <div class="text-center py-3 d-none" id="noFiles{{ $enrollment->session->id }}">
                                                                            <p class="text-muted">
                                                                                <i class="fas fa-info-circle me-1"></i>
                                                                                Aucun fichier de cours n'a été ajouté pour cette session.
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Preview area for files -->
                                                                    <div class="file-preview-container d-none" id="filePreviewContainer{{ $enrollment->session->id }}">
                                                                        <h6 class="mb-2">Aperçu du Fichier</h6>
                                                                        <iframe class="preview-iframe" id="filePreviewFrame{{ $enrollment->session->id }}" src=""></iframe>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Timetable Modal -->
                                                    @if($enrollment->session->timetable)
                                                    <div class="modal fade" id="timetableModal{{ $enrollment->session->id }}" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        <i class="fas fa-calendar me-2 text-info"></i>
                                                                        Emploi du temps - {{ $enrollment->session->title }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="text-center mb-3">
                                                                        <div class="btn-group">
                                                                            <a href="{{ route('sessions.view-timetable', $enrollment->session->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                                <i class="fas fa-external-link-alt me-1"></i> Ouvrir dans un nouvel onglet
                                                                            </a>

                                                                        </div>
                                                                    </div>

                                                                    <div class="timetable-preview mt-3">
                                                                        <img src="{{ route('sessions.view-timetable', $enrollment->session->id) }}" class="img-fluid border rounded" alt="Aperçu de l'emploi du temps" style="max-height: 500px; margin: 0 auto; display: block;">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @else
                                                    <span class="status-badge bg-warning text-white">
                                                        <i class="fas fa-clock me-1"></i> En attent
                                                    </span>
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
        </div>
    </div>
</div>

<script>
    function confirmLogout(event) {
        event.preventDefault();
        if (confirm('Voulez-vous vraiment vous déconnecter ?')) {
            document.getElementById('logout-form').submit();
        }
    }

    // Load course files for each session modal
    document.addEventListener('DOMContentLoaded', function() {
        // Get all course modals
        const courseModals = document.querySelectorAll('[id^="coursesModal"]');

        // Add event listeners to load files when modal is opened
        courseModals.forEach(modal => {
            let filesLoaded = false;
            modal.addEventListener('shown.bs.modal', function() {
                const sessionId = this.id.replace('coursesModal', '');
                // Only load files once to prevent unnecessary reloads
                if (!filesLoaded) {
                    loadCourseFiles(sessionId);
                    filesLoaded = true;
                }
            });
        });
    });

    // Function to load course files for a session
    function loadCourseFiles(sessionId) {
        const fileList = document.getElementById(`fileList${sessionId}`);
        const loaderElement = document.getElementById(`fileListLoader${sessionId}`);
        const noFilesElement = document.getElementById(`noFiles${sessionId}`);

        // Show loader, hide no files message
        loaderElement.classList.remove('d-none');
        noFilesElement.classList.add('d-none');

        // Fetch course files from API
        fetch(`/sessions/${sessionId}/course-files`)
            .then(response => response.json())
            .then(data => {
                // Hide loader
                loaderElement.classList.add('d-none');

                // Clear existing items
                const existingItems = fileList.querySelectorAll('.file-item');
                existingItems.forEach(item => {
                    if (!item.classList.contains('text-center')) {
                        item.remove();
                    }
                });

                // Check if there are files
                if (data.length === 0) {
                    noFilesElement.classList.remove('d-none');
                    return;
                }

                // Add files to the list
                data.forEach(file => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-item';

                    // Get file extension for icon selection
                    const fileName = file.title || file.file_path.split('/').pop();
                    const fileExt = fileName.split('.').pop().toLowerCase();
                    let fileIcon = 'fa-file';

                    // Choose icon based on file type
                    if (fileExt === 'pdf') fileIcon = 'fa-file-pdf';
                    else if (['doc', 'docx'].includes(fileExt)) fileIcon = 'fa-file-word';
                    else if (['xls', 'xlsx'].includes(fileExt)) fileIcon = 'fa-file-excel';
                    else if (['ppt', 'pptx'].includes(fileExt)) fileIcon = 'fa-file-powerpoint';
                    else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) fileIcon = 'fa-file-image';
                    else if (['zip', 'rar', '7z'].includes(fileExt)) fileIcon = 'fa-file-archive';

                    // Format file size
                    let fileSize = 'N/A';
                    if (file.file_size) {
                        const size = parseInt(file.file_size);
                        if (size < 1024) fileSize = `${size} B`;
                        else if (size < 1024 * 1024) fileSize = `${(size / 1024).toFixed(1)} KB`;
                        else fileSize = `${(size / (1024 * 1024)).toFixed(1)} MB`;
                    }

                    // Format date
                    const createdDate = new Date(file.created_at);
                    const formattedDate = createdDate.toLocaleDateString();

                    fileItem.innerHTML = `
                        <div>
                            <i class="fas ${fileIcon} text-primary me-2"></i>
                            <span class="file-name">${fileName}</span>
                            <small class="text-muted ms-2">${fileSize} • ${formattedDate}</small>
                        </div>
                        <div class="file-actions">
                            <button class="btn btn-sm btn-outline-info view-file" data-file-id="${file.id}" data-session-id="${sessionId}" title="Voir le fichier">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a class="btn btn-sm btn-outline-primary" href="/course-files/${file.id}" target="_blank" title="Ouvrir dans un nouvel onglet">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    `;

                    fileList.appendChild(fileItem);
                });

                // Add event listeners for file actions
                setupFileActionListeners();
            })
            .catch(error => {
                console.error('Error loading course files:', error);
                loaderElement.classList.add('d-none');

                // Show error message
                const errorElement = document.createElement('div');
                errorElement.className = 'alert alert-danger mt-3';
                errorElement.innerText = 'Erreur lors du chargement des fichiers. Veuillez réessayer.';
                fileList.appendChild(errorElement);
            });
    }

    // Global function to set up file action listeners
    function setupFileActionListeners() {
        // Remove any existing event listeners first to prevent duplicates
        document.querySelectorAll('.view-file').forEach(button => {
            const newButton = button.cloneNode(true);
            button.parentNode.replaceChild(newButton, button);
        });

        // Add new event listeners
        document.querySelectorAll('.view-file').forEach(button => {
            button.addEventListener('click', function() {
                const fileId = this.getAttribute('data-file-id');
                const sessionId = this.getAttribute('data-session-id');
                const previewContainer = document.getElementById(`filePreviewContainer${sessionId}`);
                const previewFrame = document.getElementById(`filePreviewFrame${sessionId}`);

                // Show loading state
                previewContainer.classList.remove('d-none');

                // Set a small delay to prevent flickering
                setTimeout(() => {
                    previewFrame.src = `/course-files/${fileId}`;
                }, 100);
            });
        });
    }
</script>

<!-- Add Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



