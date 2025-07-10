<?php

namespace App\Http\Controllers;

use App\Models\ChatbotMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $userMessage = $request->input('message');
            $userId = auth()->check() ? auth()->id() : null;

            // Store the user's message
            $chatMessage = ChatbotMessage::create([
                'user_message' => $userMessage,
                'bot_response' => '',
                'user_id' => $userId
            ]);

            // Generate response
            $response = $this->generateResponse($userMessage);

            // Update the stored message with the bot's response
            $chatMessage->update(['bot_response' => $response]);

            return response()->json([
                'response' => $response,
                'success' => true
            ]);

        } catch (\Exception $e) {
            Log::error('Chatbot error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    private function generateResponse($userMessage)
    {
        $userMessage = strtolower($userMessage);

        if ($this->isGreeting($userMessage)) {
            return $this->getGreetingResponse();
        }

        if ($this->detectFormationQuestion($userMessage)) {
            return $this->getFormationResponse();
        }

        if ($this->detectSupportQuestion($userMessage)) {
            return $this->getSupportResponse();
        }

        if ($this->detectCancellationQuestion($userMessage)) {
            return $this->getCancellationResponse();
        }

        return $this->getNavigationGuide();
    }

    private function detectFormationQuestion($message)
    {
        $keywords = [
            'formation', 'formations', 'courses', 'course',
            'how to get to formation', 'where is formation',
            'find formation', 'access formation', 'voir formation',
            'see formation', 'show formation'
        ];

        foreach ($keywords as $keyword) {
            if (stripos($message, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    private function getFormationResponse()
    {
        return "Pour accéder à nos formations :\n\n" .
               "1. Cliquez sur 'Nos Formations' dans le menu de navigation\n" .
               "   ou Cliquez sur tableau de bord > Formations si vous êtes connecté\n" .
               "2. Parcourez nos formations disponibles\n" .
               "3. Cliquez sur n'importe quelle formation pour voir ses détails et les sessions disponibles\n" .
               "4. Pour vous inscrire à une formation :\n" .
               "   - Si vous n'êtes pas connecté, cliquez sur 'S'inscrire' ou 'Se connecter'\n" .
               "   - Une fois connecté, vous pouvez vous inscrire à n'importe quelle session\n\n" .
               "Besoin de plus d'informations ? N'hésitez pas à demander !";
    }

    private function detectSupportQuestion($message)
    {
        $keywords = [
            'support', 'help', 'contact', 'assistance',
            'how to contact', 'where to get help',
            'need help', 'support team', 'contact support',
            'reach out', 'assistance needed', 'customer service'
        ];

        foreach ($keywords as $keyword) {
            if (stripos($message, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    private function getSupportResponse()
    {
        return "Voici comment obtenir de l'aide :\n\n" .
               "1. Contacter l'équipe de support :\n" .
               "   • Cliquez sur 'Contact' dans le menu de navigation\n" .
               "   • Remplissez le formulaire de contact avec votre demande\n" .
               "   • Notre équipe répond généralement sous 24 heures\n\n" .
               "2. Options de support direct :\n" .
               "   • Email : support@e-learn.com\n" .
               "   • Téléphone : Disponible pendant les heures de bureau\n" .
               "   • Chat en direct : Cliquez sur l'icône de chat en bas à droite\n\n" .
               "3. Section FAQ :\n" .
               "   • Consultez notre page FAQ pour des réponses rapides\n" .
               "   • Parcourez les questions et solutions courantes\n\n" .
               "Besoin d'une assistance immédiate ? Dites-moi de quelle aide spécifique vous avez besoin !";
    }

    private function detectCancellationQuestion($message)
    {
        $keywords = [
            'cancel', 'cancellation', 'unenroll', 'withdraw',
            'drop course', 'drop formation', 'remove enrollment',
            'quit course', 'quit formation', 'stop course',
            'how to cancel', 'can i cancel', 'want to cancel'
        ];

        foreach ($keywords as $keyword) {
            if (stripos($message, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    private function getCancellationResponse()
    {
        return "Pour annuler votre inscription à une formation :\n\n" .
               "1. Accédez à vos inscriptions :\n" .
               "   • Connectez-vous à votre compte\n" .
               "   • Allez dans Tableau de bord > Mes inscriptions\n\n" .
               "2. Annuler l'inscription :\n" .
               "   • Trouvez la formation que vous souhaitez annuler\n" .
               "   • Cliquez sur le bouton 'Annuler l'inscription' ou '✕'\n" .
               "   • Confirmez votre annulation\n\n" .
               "3. Notes importantes :\n" .
               "   • La politique d'annulation peut s'appliquer\n" .
               "   • Certaines formations ont des délais d'annulation\n" .
               "   • Contactez le support si vous avez besoin d'aide\n\n" .
               "Besoin d'aide pour annuler une formation spécifique ? N'hésitez pas à demander !";
    }

    private function isGreeting($message)
    {
        $greetings = ['hello', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening'];
        return Str::contains($message, $greetings);
    }

    private function getGreetingResponse()
    {
        return "👋 Bonjour ! Voici comment naviguer sur notre plateforme :

1. Voir les Formations 📚
   • Allez dans Tableau de bord > Formations
   • Cliquez sur n'importe quelle formation pour voir ses sessions
   • Inscrivez-vous à une session en cliquant sur 'S'inscrire maintenant'
   • Parcourez les cours disponibles et leurs détails

2. Espace Étudiant 🎓
   • Accédez à votre Interface Étudiant
   • Consultez vos cours et matériels pédagogiques

3. Contact & Support 📞
   • Cliquez sur 'Contact' dans le menu de navigation
   • Contactez notre équipe de support

Besoin de plus d'aide ? N'hésitez pas à demander !";
    }

    private function getNavigationGuide()
    {
        return "Voici comment naviguer sur notre plateforme :

1. Voir les Formations 📚
   • Allez dans Tableau de bord > Formations
   • Cliquez sur n'importe quelle formation pour voir ses sessions
   • Inscrivez-vous à une session en cliquant sur 'S'inscrire maintenant'
   • Parcourez les cours disponibles et leurs détails

2. Espace Étudiant 🎓
   • Accédez à votre Interface Étudiant en cliquant sur Tableau de bord
   • Consultez vos cours et matériels pédagogiques

3. Contact & Support 📞
   • Cliquez sur 'Contact' dans le menu de navigation
   • Contactez notre équipe de support

Besoin de plus d'aide ? N'hésitez pas à demander !";
    }

    public function show()
    {
        return view('chatbot');
    }
}
