<!-- Add Bootstrap CSS and Custom Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
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
        background: #ffffff;
        border-bottom: 1px solid #ffffff;
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
    .spinner-overlay {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 1000;
        justify-content: center;
        align-items: center;
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
    /* Add missing timetable preview styles */
    .timetable-preview {
        text-align: center;
        max-width: 100%;
        margin: 15px auto;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
    }
    .timetable-preview img {
        max-width: 100%;
        max-height: 400px;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    /* Fix for image display issues */
    img.img-fluid {
        display: block;
        margin: 0 auto;
    }
</style>
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <i class="fas fa-chalkboard-teacher me-2"></i>Formateur
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Lien Accueil vers teacher-interface -->
                <li class="nav-item">
                    <a class="nav-link text-dark {{ Request::is('teacher-interface') ? 'active-link' : '' }}" href="{{ url('/teacher-interface') }}">
                        <i class="fas fa-home me-2"></i> Accueil
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





<div class="page-header">
    <div class="container">
        <h2 class="display-4 text-center mb-2">Tableau de bord "Formateur" </h2>
        <p class="lead text-center text-muted"><strong>Nous sommes heureux de vous accueillir parmi notre équipe de formateurs. Votre expertise représente un véritable atout pour enrichir notre communauté d'apprenants et garantir des contenus de qualité. Encore une fois, bienvenue parmi nous !</strong>
        </p>
    </div>
</div>

<div class="container">

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0"> Vos Sessions</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">Nom</th>
                            <th class="border-0">Description</th>
                            <th class="border-0">Date Debut</th>
                            <th class="border-0">Date Fin</th>
                            <th class="border-0">Actions</th>
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
                                <div class="btn-group">
                                    <a href="{{ route('session.students', $session->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-users me-1"></i>Apprenants
                                    </a>

                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#multiCourseModal{{ $session->id }}">
                                        <i class="fas fa-book me-1"></i>Gérer Cours
                                    </button>
                                    <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#timetableModal{{ $session->id }}">
                                        <i class="fas fa-calendar-alt me-1"></i> {{ $session->timetable ? 'Update Timetable' : 'Add Timetable' }}
                                    </button>
                                </div>

                                <!-- Multiple Course Files Modal -->
                                <div class="modal fade" id="multiCourseModal{{ $session->id }}" tabindex="-1" aria-labelledby="multiCourseModalLabel{{ $session->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="multiCourseModalLabel{{ $session->id }}">
                                                    <i class="fas fa-file-alt me-2 text-primary"></i>
                                                    Gérer les Fichiers de Cours - {{ $session->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Upload new course file form -->
                                                <form action="{{ route('course-files.store', $session->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="title{{ $session->id }}" class="form-label">Titre du fichier (optionnel)</label>
                                                        <input type="text" class="form-control" id="title{{ $session->id }}" name="title" placeholder="Entrez un titre descriptif">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="file{{ $session->id }}" class="form-label">Fichier de Cours</label>
                                                        <input type="file" class="form-control" id="file{{ $session->id }}" name="file" required>
                                                        <small class="text-muted">Taille max: 10MB</small>
                                                    </div>
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-upload me-1"></i> Ajouter un Fichier
                                                        </button>
                                                    </div>
                                                </form>

                                                <hr>

                                                <!-- List of existing course files -->
                                                <h6 class="mb-3">Fichiers de Cours</h6>
                                                <div class="position-relative">
                                                    <div class="spinner-overlay" id="spinnerOverlay{{ $session->id }}">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="file-list" id="fileList{{ $session->id }}">
                                                        <!-- Files will be loaded here via JavaScript -->
                                                        <div class="text-center py-3" id="fileListLoader{{ $session->id }}">
                                                            <div class="spinner-border spinner-border-sm text-primary me-2" role="status">
                                                                <span class="visually-hidden">Chargement...</span>
                                                            </div>
                                                            Chargement des fichiers...
                                                        </div>
                                                        <div class="text-center py-3 d-none" id="noFiles{{ $session->id }}">
                                                            <p class="text-muted">
                                                                <i class="fas fa-info-circle me-1"></i>
                                                                Aucun fichier de cours n'a été ajouté pour cette session.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Preview area for files -->
                                                <div class="file-preview-container d-none" id="filePreviewContainer{{ $session->id }}">
                                                    <h6 class="mb-2">Aperçu du Fichier</h6>
                                                    <iframe class="preview-iframe" id="filePreviewFrame{{ $session->id }}" src=""></iframe>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timetable Upload Modal -->
                                <div class="modal fade" id="timetableModal{{ $session->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                                    {{ $session->timetable ? 'Modifier l\'Emploi du Temps' : 'Ajouter un Emploi du Temps' }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Timetable Update Form -->
                                                <form action="{{ route('sessions.update2', $session->id) }}" method="POST" enctype="multipart/form-data" class="mb-4 border rounded p-3 bg-light">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">

                                                    <div class="mb-3">
                                                        <label for="timetable{{ $session->id }}" class="form-label fw-bold">
                                                            {{ $session->timetable ? 'Changer l\'image de l\'emploi du temps' : 'Ajouter une image d\'emploi du temps' }}
                                                        </label>
                                                        <input type="file" class="form-control" id="timetable{{ $session->id }}" name="timetable"
                                                            accept="image/jpeg,image/png,image/jpg,image/gif" required>
                                                        <div class="form-text">Formats supportés: JPG, PNG, GIF (max: 2MB)</div>
                                                    </div>

                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save me-1"></i> {{ $session->timetable ? 'Mettre à jour' : 'Enregistrer' }}
                                                        </button>
                                                    </div>
                                                </form>

                                                <!-- Current Timetable Display (if exists) -->
                                                @if($session->timetable)
                                                <div class="mt-4">
                                                    <h6 class="border-bottom pb-2 mb-3">Emploi du Temps Actuel</h6>

                                                    <div class="text-center mb-3">
                                                        <div class="btn-group">
                                                            <a href="{{ route('sessions.view-timetable', $session->id) }}"
                                                               target="_blank"
                                                               class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-external-link-alt me-1"></i> Voir en plein écran
                                                            </a>

                                                        </div>
                                                    </div>

                                                    <!-- Timetable preview -->
                                                    <div class="timetable-preview mt-3">
                                                        <img src="{{ route('sessions.view-timetable', $session->id) }}?v={{ time() }}"
                                                             class="img-fluid border rounded"
                                                             alt="Aperçu de l'emploi du temps"
                                                             style="max-height: 500px; margin: 0 auto; display: block;">
                                                    </div>
                                                </div>
                                                @else
                                                <div class="alert alert-info mt-4">
                                                    <i class="fas fa-info-circle me-1"></i> Aucun emploi du temps n'a été téléchargé pour cette session.
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

    // Document ready function for setting up event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Set up course modals
        const courseModals = document.querySelectorAll('[id^="multiCourseModal"]');
        courseModals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function() {
                const sessionId = this.id.replace('multiCourseModal', '');
                loadCourseFiles(sessionId);
            });
        });

        // Set up timetable form submission
        setupTimetableFormSubmissions();

        // Check for success message in URL and display alert
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('timetable_updated')) {
            const sessionId = urlParams.get('session_id');
            if (sessionId) {
                showTimetableUpdateSuccess(sessionId);
                // Clean URL without refreshing the page
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        }
    });

    // Function to set up timetable form submissions
    function setupTimetableFormSubmissions() {
        document.querySelectorAll('[id^="timetableForm"]').forEach(form => {
            form.addEventListener('submit', function(event) {
                const sessionId = this.id.replace('timetableForm', '');
                const submitBtn = document.getElementById(`submitTimetableBtn${sessionId}`);

                // Change button state to loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Téléchargement...';
            });
        });
    }

    // Function to show success message after timetable update
    function showTimetableUpdateSuccess(sessionId) {
        const updateSuccess = document.getElementById(`updateSuccess${sessionId}`);
        if (updateSuccess) {
            updateSuccess.classList.remove('d-none');

            // Automatically hide after 5 seconds
            setTimeout(() => {
                updateSuccess.classList.add('d-none');
            }, 5000);

            // Also update the image source with a cache-busting parameter
            const currentTimetableImg = document.getElementById(`currentTimetableImg${sessionId}`);
            if (currentTimetableImg) {
                const imgSrc = currentTimetableImg.src.split('?')[0];
                currentTimetableImg.src = imgSrc + '?v=' + new Date().getTime();
            }

            // Update the "Open in new tab" link to ensure it has the latest version
            const viewTimetableBtn = document.getElementById(`viewTimetableBtn${sessionId}`);
            if (viewTimetableBtn) {
                const href = viewTimetableBtn.href.split('?')[0];
                viewTimetableBtn.href = href + '?v=' + new Date().getTime();
            }
        }
    }

    // Preview timetable image before upload
    function previewTimetableImage(sessionId) {
        const input = document.getElementById(`timetable${sessionId}`);
        const previewContainer = document.getElementById(`timetablePreview${sessionId}`);
        const previewImg = document.getElementById(`previewImg${sessionId}`);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    }

    // Load course files for a session
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
                            <button class="btn btn-sm btn-outline-info view-file" data-file-id="${file.id}" title="Voir le fichier">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a class="btn btn-sm btn-outline-primary" href="/course-files/${file.id}" target="_blank" title="Ouvrir dans un nouvel onglet">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger delete-file" data-file-id="${file.id}" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;

                    fileList.appendChild(fileItem);
                });

                // Add event listeners for file actions
                setupFileActionListeners(sessionId);
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

    // Setup event listeners for file action buttons
    function setupFileActionListeners(sessionId) {
        // View file buttons
        const viewButtons = document.querySelectorAll(`#fileList${sessionId} .view-file`);
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const fileId = this.getAttribute('data-file-id');
                const previewContainer = document.getElementById(`filePreviewContainer${sessionId}`);
                const previewFrame = document.getElementById(`filePreviewFrame${sessionId}`);

                previewFrame.src = `/course-files/${fileId}`;
                previewContainer.classList.remove('d-none');
            });
        });

        // Delete file buttons
        const deleteButtons = document.querySelectorAll(`#fileList${sessionId} .delete-file`);
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Êtes-vous sûr de vouloir supprimer ce fichier ? Cette action est irréversible.')) {
                    const fileId = this.getAttribute('data-file-id');
                    const spinnerOverlay = document.getElementById(`spinnerOverlay${sessionId}`);

                    // Show spinner overlay
                    spinnerOverlay.style.display = 'flex';

                    // Send delete request
                    fetch(`/course-files/${fileId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(() => {
                        // Hide spinner overlay
                        spinnerOverlay.style.display = 'none';

                        // Reload course files list
                        loadCourseFiles(sessionId);

                        // Hide preview if open
                        const previewContainer = document.getElementById(`filePreviewContainer${sessionId}`);
                        previewContainer.classList.add('d-none');
                    })
                    .catch(error => {
                        console.error('Error deleting file:', error);

                        // Hide spinner overlay
                        spinnerOverlay.style.display = 'none';

                        // Show error alert
                        alert('Erreur lors de la suppression du fichier. Veuillez réessayer.');
                    });
                }
            });
        });
    }
</script>

<!-- Add Bootstrap JS and Font Awesome -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Add CSRF Token Meta -->
<meta name="csrf-token" content="{{ csrf_token() }}">


