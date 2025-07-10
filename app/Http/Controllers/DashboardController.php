<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role_id != 1) {
                abort(403, 'Unauthorized action.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $studentsCount = User::where('role_id', 3)->count();
        $teachersCount = User::where('role_id', 2)->count();
        $sessionsCount = Session::count();
        $acceptedEnrollmentsCount = DB::table('enrollment')->where('status', 'accepted')->count();
        $pendingEnrollmentsCount = DB::table('enrollment')->where('status', 'pending')->count();
        $usersCount = User::count();
        $message = DB::table('admin_messages')->latest()->first();

        return view('dashboard', [
            'studentsCount' => $studentsCount,
            'teachersCount' => $teachersCount,
            'sessionsCount' => $sessionsCount,
            'acceptedEnrollmentsCount' => $acceptedEnrollmentsCount,
            'pendingEnrollmentsCount' => $pendingEnrollmentsCount,
            'usersCount' => $usersCount,
            'message' => $message,
        ]);
    }

    public function manageEnrollments(Request $request)
    {
        $enrollments = DB::table('enrollment')->get();

        // Get formations and their sessions for each enrollment
        $formationSessions = [];
        foreach ($enrollments as $enrollment) {
            if (!isset($formationSessions[$enrollment->formation_id])) {
                // Fetch sessions for this formation if we haven't already
                $formationSessions[$enrollment->formation_id] = DB::table('sessions')
                    ->where('formation_id', $enrollment->formation_id)
                    ->get();
            }
        }

        return view('enrollments', [
            'enrollments' => $enrollments,
            'formationSessions' => $formationSessions,
        ]);
    }

    public function updateEnrollmentStatus(Request $request, $id)
    {
        $status = $request->input('status');
        $updateData = ['status' => $status];
        $enrollment = DB::table('enrollment')->where('id', $id)->first();
        $user = User::find($enrollment->user_id);
        $formation = DB::table('formations')->where('id', $enrollment->formation_id)->first();

        // If status is accepted and session_id is provided, update the session_id
        if ($status === 'accepted' && $request->has('session_id')) {
            $updateData['session_id'] = $request->input('session_id');
            $session = DB::table('sessions')->where('id', $request->input('session_id'))->first();

            // Create different success message based on whether this is a new acceptance or session change
            if ($enrollment->status === 'accepted') {
                $successMessage = "La session de {$user->name} pour la formation '{$formation->name}' a été modifiée avec succès.";
            } else {
                $successMessage = "La demande de {$user->name} pour la formation '{$formation->name}' a été acceptée et assignée à la session '{$session->title}'.";
            }
        } else {
            $successMessage = "Le statut de la demande a été mis à jour avec succès.";
        }

        DB::table('enrollment')->where('id', $id)->update($updateData);

        return redirect()->route('enrollments.index')->with('success', $successMessage);
    }

    public function deleteEnrollment($id)
    {
        $enrollment = DB::table('enrollment')->where('id', $id)->first();
        $user = User::find($enrollment->user_id);
        $formation = DB::table('formations')->where('id', $enrollment->formation_id)->first();

        DB::table('enrollment')->where('id', $id)->delete();

        return redirect()->route('enrollments.index')->with('success', "La demande de {$user->name} pour la formation '{$formation->name}' a été supprimée avec succès.");
    }
}
