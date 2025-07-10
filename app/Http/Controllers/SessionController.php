<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function index(Request $request)
    {
        $formationId = $request->query('formation_id');

        if ($formationId) {
            $sessions = Session::where('formation_id', $formationId)->get();
        } else {
            $sessions = Session::all();
        }

        return view('sessionad', compact('sessions'));
    }

    // Show the form for creating a new session
    public function create()
    {
        $formations = Formation::all(); // Fetch all formations
        $teachers = User::where('role_id', 2)->get(); // Fetch all teachers
        return view('sessions.create', compact('formations', 'teachers'));
    }

    // Store a newly created session in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'teacher_id' => 'nullable|exists:users,id',
            'formation_id' => 'required|exists:formation,id',
            'course' => 'nullable|file|mimes:pdf|max:2048', // Allow PDF files up to 2MB
            'timetable' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sessionData = $request->except(['course', 'timetable']);

        // Handle file uploads
        if ($request->hasFile('course')) {
            $file = $request->file('course');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/courses', $fileName, 'public');
            $sessionData['course'] = 'storage/' . $filePath;
        }

        if ($request->hasFile('timetable')) {
            $file = $request->file('timetable');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/timetables', $fileName, 'public');
            $sessionData['timetable'] = 'storage/' . $filePath;
        }

        Session::create($sessionData);

        return redirect()->route('formation.index')->with('success', 'Session created successfully.');
    }

    // Show the form for editing the specified session
    public function edit(Session $session)
    {
        $formations = Formation::all(); // Fetch all formations
        $teachers = User::where('role_id', 2)->get(); // Fetch all teachers
        return view('sessions.edit', compact('session', 'formations', 'teachers'));
    }

    // Update the specified session in storage
    public function update(Request $request, Session $session)
    {
        $request->validate([
            'title' => $request->has('title') ? 'required|string|max:255' : '',
            'description' => $request->has('description') ? 'nullable|string' : '',
            'start_time' => $request->has('start_time') ? 'required|date' : '',
            'end_time' => $request->has('end_time') ? 'required|date|after_or_equal:start_time' : '',
            'teacher_id' => $request->has('teacher_id') ? 'nullable|exists:users,id' : '',
            'formation_id' => $request->has('formation_id') ? 'required|exists:formation,id' : '',
            'course' => 'nullable|file|mimes:pdf|max:2048',
            'timetable' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file uploads if present
        if ($request->hasFile('course')) {
            // Delete old course file if it exists
            if ($session->course) {
                $oldPath = storage_path('app/public/' . str_replace('storage/', '', $session->course));
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('course');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/courses', $fileName, 'public');
            $session->course = 'storage/' . $filePath;
        }

        if ($request->hasFile('timetable')) {
            // Delete old timetable file if it exists
            if ($session->timetable) {
                $oldPath = storage_path('app/public/' . str_replace('storage/', '', $session->timetable));
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('timetable');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/timetables', $fileName, 'public');
            $session->timetable = 'storage/' . $filePath;
        }

        // Only update other fields if they are present in the request
        if ($request->has('title')) $session->title = $request->title;
        if ($request->has('description')) $session->description = $request->description;
        if ($request->has('start_time')) $session->start_time = $request->start_time;
        if ($request->has('end_time')) $session->end_time = $request->end_time;
        if ($request->has('teacher_id')) $session->teacher_id = $request->teacher_id;
        if ($request->has('formation_id')) $session->formation_id = $request->formation_id;

        $session->save();

        return redirect()->route('formation.index')->with('success', 'Session updated successfully');
    }

    // Update the specified session in storage (used for timetable updates)
    public function update2(Request $request, Session $session)
    {
        $request->validate([
            'title' => $request->has('title') ? 'required|string|max:255' : '',
            'description' => $request->has('description') ? 'nullable|string' : '',
            'start_time' => $request->has('start_time') ? 'required|date' : '',
            'end_time' => $request->has('end_time') ? 'required|date|after_or_equal:start_time' : '',
            'teacher_id' => $request->has('teacher_id') ? 'nullable|exists:users,id' : '',
            'formation_id' => $request->has('formation_id') ? 'required|exists:formation,id' : '',
            'course' => 'nullable|file|mimes:pdf|max:2048',
            'timetable' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Keep track of whether we're updating the timetable
        $timetableUpdated = false;

        // Handle file uploads if present
        if ($request->hasFile('course')) {
            // Delete old course file if it exists
            if ($session->course) {
                $oldPath = storage_path('app/public/' . str_replace('storage/', '', $session->course));
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('course');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/courses', $fileName, 'public');
            $session->course = 'storage/' . $filePath;
        }

        if ($request->hasFile('timetable')) {
            // Delete old timetable file if it exists
            if ($session->timetable) {
                $oldPath = storage_path('app/public/' . str_replace('storage/', '', $session->timetable));
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('timetable');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/timetables', $fileName, 'public');
            $session->timetable = 'storage/' . $filePath;
            $timetableUpdated = true;
        }

        // Only update other fields if they are present in the request
        if ($request->has('title')) $session->title = $request->title;
        if ($request->has('description')) $session->description = $request->description;
        if ($request->has('start_time')) $session->start_time = $request->start_time;
        if ($request->has('end_time')) $session->end_time = $request->end_time;
        if ($request->has('teacher_id')) $session->teacher_id = $request->teacher_id;
        if ($request->has('formation_id')) $session->formation_id = $request->formation_id;

        $session->save();

        // Redirect back to the previous page if specified, otherwise to the default route
        if ($request->has('redirect_url')) {
            $redirectUrl = $request->input('redirect_url');

            // Add parameters to indicate successful timetable update
            if ($timetableUpdated) {
                $redirectUrl = $this->addQueryParam($redirectUrl, 'timetable_updated', 'true');
                $redirectUrl = $this->addQueryParam($redirectUrl, 'session_id', $session->id);
            }

            return redirect($redirectUrl)->with('success', 'Session updated successfully');
        }

        return redirect()->route('teacher.dashboard')->with('success', 'Session updated successfully');
    }

    /**
     * Helper method to add query parameters to a URL
     */
    private function addQueryParam($url, $key, $value)
    {
        $separator = (parse_url($url, PHP_URL_QUERY) == NULL) ? '?' : '&';
        return $url . $separator . $key . '=' . $value;
    }

    // Remove the specified session from storage
    public function destroy(Session $session)
    {
        $session->delete();

        return redirect()->route('sessions.index')->with('success', 'Session action completed successfully.');
    }

    // Cancel enrollment for a session
    public function cancelEnrollment(Formation $session)
    {
        $user = auth()->user();

        // Check if the user is enrolled in the session
        $existingEnrollment = $session->enrollments()->where('user_id', $user->id)->first();

        if (!$existingEnrollment) {
            return redirect()->back()->with('error', 'You are not enrolled in this session.');
        }

        // Delete the enrollment
        $existingEnrollment->delete();

        return redirect()->back()->with('success', 'Your enrollment has been canceled.');
    }

    // Get enrolled students for a session
    public function getEnrolledStudents(Session $session)
    {
        // Fetch enrollments for the session
        $enrollments = $session->enrollments;

        // Extract user IDs from enrollments
        $userIds = $enrollments->pluck('user_id');

        // Fetch user details for the extracted user IDs
        $students = User::whereIn('id', $userIds)->get();

        return view('sessions.students', compact('session', 'students'));
    }

    public function downloadCourse(Session $session)
    {
        // Check if user is enrolled in this session and enrollment is accepted
        $enrollment = $session->enrollments()->where('user_id', auth()->id())->first();

        if (!$enrollment) {
            return redirect()->back()->with('error', 'You must be enrolled in this session to download the course material.');
        }

        if ($enrollment->status !== 'accepted') {
            return redirect()->back()->with('error', 'Your enrollment must be accepted to download the course material.');
        }

        if (!$session->course) {
            return redirect()->back()->with('error', 'No course material available for this session.');
        }

        $filePath = storage_path('app/public/' . str_replace('storage/', '', $session->course));

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Course file not found.');
        }

        return response()->download($filePath);
    }

    public function downloadTimetable(Session $session)
    {
        // Check if user is authorized to download this timetable
        $isAssignedTeacher = $session->teacher_id == auth()->id();
        $isAnyTeacher = auth()->user()->role_id == 2; // Any user with teacher role
        $isEnrolledStudent = $session->enrollments()
            ->where('user_id', auth()->id())
            ->where('status', 'accepted')
            ->exists();
        $isAdmin = auth()->user()->role_id == 1;

        // Allow access to: assigned teacher, any teacher, enrolled students, or admins
        if (!$isAssignedTeacher && !$isAnyTeacher && !$isEnrolledStudent && !$isAdmin) {
            return redirect()->back()->with('error', 'You are not authorized to download this timetable.');
        }

        if (!$session->timetable) {
            return redirect()->back()->with('error', 'No timetable available for this session.');
        }

        $filePath = storage_path('app/public/' . str_replace('storage/', '', $session->timetable));

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Timetable file not found.');
        }

        return response()->download($filePath);
    }

    /**
     * Display the timetable image in the browser.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function viewTimetable(Session $session)
    {


        $filePath = storage_path('app/public/' . str_replace('storage/', '', $session->timetable));

        if (!file_exists($filePath)) {
            return response()->view('errors.403', [
                'message' => 'Timetable file not found.'
            ], 403);
        }

        // Get file mime type
        $mimeType = mime_content_type($filePath);

        // Add cache control headers to prevent browser caching
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT'
        ];

        // Return the file with appropriate headers for inline display
        return response()->file($filePath, $headers);
    }
}
