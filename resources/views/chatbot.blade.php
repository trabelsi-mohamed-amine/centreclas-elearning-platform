@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-gradient text-white" style="background: linear-gradient(to right, #eb69d7, #9b4eb0);">
                    <h3 class="mb-0">Assistant de Navigation</h3>
                </div>
                <div class="card-body">
                    <!-- Quick Action Buttons -->
                    <div class="mb-3 d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-secondary quick-question" data-question="Comment accéder aux formations ?">
                            <i class="fas fa-book-open"></i> Accès Formations
                        </button>
                        <button type="button" class="btn btn-outline-secondary quick-question" data-question="Comment s'inscrire à un cours ?">
                            <i class="fas fa-user-plus"></i> Inscription aux cours
                        </button>
                        <button type="button" class="btn btn-outline-secondary quick-question" data-question="Où est l'espace étudiant ?">
                            <i class="fas fa-user-graduate"></i> Espace Étudiant
                        </button>
                        <button type="button" class="btn btn-outline-secondary quick-question" data-question="Comment contacter le support ?">
                            <i class="fas fa-headset"></i> Contacter le Support
                        </button>
                    </div>

                    <div id="chat-messages" class="mb-3" style="height: 300px; overflow-y: auto;">
                        <!-- Messages will appear here -->
                    </div>
                    <form id="chat-form" class="d-flex gap-2">
                        <input type="text" id="user-message" class="form-control" placeholder="Posez une question sur la navigation...">
                        <button type="submit" class="btn text-white" style="background: linear-gradient(to right, #eb69d7, #9b4eb0);">
                            Envoyer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('chat-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const messageInput = document.getElementById('user-message');
    const message = messageInput.value.trim();
    if (!message) return;

    // Display user message
    appendMessage('user', message);
    messageInput.value = '';

    try {
        const response = await fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message })
        });

        const data = await response.json();
        if (data.success) {
            appendMessage('bot', data.response);
        } else {
            appendMessage('bot', 'Désolé, j\'ai rencontré une erreur. Veuillez réessayer.');
        }
    } catch (error) {
        appendMessage('bot', 'Désolé, j\'ai rencontré une erreur. Veuillez réessayer.');
    }
});

// Add click handlers for quick question buttons
document.querySelectorAll('.quick-question').forEach(button => {
    button.addEventListener('click', function() {
        const question = this.getAttribute('data-question');
        document.getElementById('user-message').value = question;
        document.getElementById('chat-form').dispatchEvent(new Event('submit'));
    });
});

function appendMessage(sender, message) {
    const chatMessages = document.getElementById('chat-messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = `mb-3 ${sender === 'user' ? 'text-end' : ''}`;

    const messageBubble = document.createElement('div');
    messageBubble.className = sender === 'user' ? 'btn btn-light text-start' : 'btn text-white text-start';
    if (sender === 'bot') {
        messageBubble.style.background = 'linear-gradient(to right, #eb69d7, #9b4eb0)';
    }
    messageBubble.style.maxWidth = '80%';
    messageBubble.style.whiteSpace = 'pre-wrap';
    messageBubble.textContent = message;

    messageDiv.appendChild(messageBubble);
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}
</script>
@endsection
