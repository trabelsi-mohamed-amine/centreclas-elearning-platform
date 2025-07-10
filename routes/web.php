<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CourseFileController;
use App\Models\Formation;
use App\Models\Session;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['web'])->group(function () {
    Route::get('/chat', [ChatbotController::class, 'show'])->name('chatbot.show');
    Route::post('/chat', [ChatbotController::class, 'chat'])->name('chatbot.chat');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::get('/students/create', function () {
        return view('add-student');
    })->name('students.create');
    Route::get('/students/download-timetable', [StudentController::class, 'downloadTimetable'])->name('students.download-timetable');
    Route::get('/students/list', [StudentController::class, 'listStudents'])->name('students.list');

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::get('/teachers/create', function () {
        return view('add-teacher');
    })->name('teachers.create');

    Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
    Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');
    Route::get('/sessions/{session}/edit', [SessionController::class, 'edit'])->name('sessions.edit');
    Route::put('/sessions/{session}', [SessionController::class, 'update'])->name('sessions.update');
    Route::put('/sessions/{session}/update2', [SessionController::class, 'update2'])->name('sessions.update2');
    Route::delete('/sessions/{session}', [SessionController::class, 'destroy'])->name('sessions.destroy');
    Route::get('/sessions/{session}/students', [SessionController::class, 'getEnrolledStudents'])->name('session.students');

    Route::get('/enrollments', [DashboardController::class, 'manageEnrollments'])->name('enrollments.index');
    Route::post('/enrollments/{id}/update', [DashboardController::class, 'updateEnrollmentStatus'])->name('enrollments.update');
    Route::delete('/enrollments/{id}', [DashboardController::class, 'deleteEnrollment'])->name('enrollments.destroy');
    Route::get('/formation', function () {
        $formations = Formation::all();
        return view('formation.index', compact('formations'));
    })->name('formation.index');

    Route::get('/formation/{formation}/sessions', function (Formation $formation) {
        $sessions = $formation->sessions;
        return view('formation.sessions', compact('formation', 'sessions'));
    })->name('formation.sessions');

    Route::post('/sessions/{session}/enroll', function (Formation $session) {
        $user = auth()->user();

        // Check if the user is already enrolled in the session
        $existingEnrollment = $session->enrollments()->where('user_id', $user->id)->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'You are already enrolled in this session.');
        }

        // Create a new enrollment
        $session->enrollments()->create(['user_id' => $user->id]);

        return redirect()->back()->with('success', 'You have successfully enrolled in the session.');
    })->name('sessions.enroll');

    Route::delete('/sessions/{session}/cancel-enrollment', [SessionController::class, 'cancelEnrollment'])->name('sessions.cancel-enrollment');

    // Routes for managing formations
    Route::resource('formation', FormationController::class)->except(['show']);

    // Route to display the admin message
    Route::get('/admin/dashboard', [AdminMessageController::class, 'index'])->name('admin.dashboard');

    // Route to store or update the admin message
    Route::post('/admin/message', [AdminMessageController::class, 'store'])->name('admin.message.store');

    // Route for admin messages
    Route::get('/admin/messages', [AdminMessageController::class, 'index'])->name('admin.messages');

    // Routes for account settings
    Route::get('/account-settings', [AccountController::class, 'edit'])->name('account.settings');
    Route::post('/account-settings', [AccountController::class, 'update'])->name('account.settings.update');
});

// Dedicated interfaces for students and teachers
Route::middleware(['auth'])->group(function () {
    Route::get('/student-interface', [StudentController::class, 'studentInterface'])->name('students.interface')->middleware('role:3');
    Route::get('/teacher-interface', [TeacherController::class, 'teacherInterface'])->name('teachers.interface')->middleware('role:2');

    // Course Files routes
    Route::post('/course-files/{sessionId}', [CourseFileController::class, 'store'])->name('course-files.store');
    Route::delete('/course-files/{id}', [CourseFileController::class, 'destroy'])->name('course-files.destroy');
    Route::get('/course-files/{id}', [CourseFileController::class, 'show'])->name('course-files.show');
    Route::get('/sessions/{sessionId}/course-files', [CourseFileController::class, 'getSessionFiles'])->name('sessions.course-files');

    // View timetable route (accessible to both teachers and students)
    Route::get('/sessions/{session}/view-timetable', [SessionController::class, 'viewTimetable'])->name('sessions.view-timetable');
});

// Dedicated routes for students to access formations and sessions
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/student/formations', function (Request $request) {
        $search = $request->query('search');
        $formations = Formation::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('description', 'like', "%$search%");
        })->get();

        return view('formation.index_for_students', compact('formations'));
    })->name('student.formations.index');

    Route::get('/student/formations/{formation}/sessions', function (Formation $formation) {
        $sessions = $formation->sessions;
        return view('formation.sessions', compact('formation', 'sessions'));
    })->name('student.formations.sessions');

    // Add routes for course download - keeping this student-specific
    Route::get('/sessions/{session}/download-course', [SessionController::class, 'downloadCourse'])->name('sessions.download-course');
});

Route::get('/formation/{formation}/sessions', [FormationController::class, 'showSessions'])->name('formation.sessions');

Route::get('/a-propos', function () {
    return view('a-propos');
});
Route::get('/nos-formations', function () {
    $formations = \App\Models\Formation::all();
    return view('nos-formations', compact('formations'));
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

require __DIR__.'/auth.php';

