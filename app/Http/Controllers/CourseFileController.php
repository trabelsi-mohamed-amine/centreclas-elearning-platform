<?php

namespace App\Http\Controllers;

use App\Models\CourseFile;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseFileController extends Controller
{
    /**
     * Store a newly created course file in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $sessionId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $sessionId)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max file size
            'title' => 'nullable|string|max:255',
        ]);

        $session = Session::findOrFail($sessionId);

        // Check if user is the teacher of this session
        if ($session->teacher_id != auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to add files to this session.');
        }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/courses', $fileName, 'public');

        CourseFile::create([
            'session_id' => $sessionId,
            'title' => $request->title ?? $file->getClientOriginalName(),
            'file_path' => 'storage/' . $filePath,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()->back()->with('success', 'Course file uploaded successfully.');
    }

    /**
     * Remove the specified course file from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $courseFile = CourseFile::findOrFail($id);

        // Check if user is the teacher of this session
        if ($courseFile->session->teacher_id != auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this file.');
        }

        // Delete the actual file
        $filePath = str_replace('storage/', '', $courseFile->file_path);
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Delete the database record
        $courseFile->delete();

        return redirect()->back()->with('success', 'Course file deleted successfully.');
    }

    /**
     * Display the specified course file in the browser.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courseFile = CourseFile::findOrFail($id);

        // Check if user is authorized to view this file (teacher or enrolled student)
        $isTeacher = $courseFile->session->teacher_id == auth()->id();
        $isEnrolledStudent = $courseFile->session->enrollments()
            ->where('user_id', auth()->id())
            ->where('status', 'accepted')
            ->exists();

        if (!$isTeacher && !$isEnrolledStudent) {
            return redirect()->back()->with('error', 'You are not authorized to view this file.');
        }

        $filePath = storage_path('app/public/' . str_replace('storage/', '', $courseFile->file_path));

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $contentType = $courseFile->mime_type;
        $headers = [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
        ];

        return response()->file($filePath, $headers);
    }

    /**
     * Get all course files for a session.
     *
     * @param  int  $sessionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSessionFiles($sessionId)
    {
        $session = Session::findOrFail($sessionId);

        // Check if user is authorized to view these files
        $isTeacher = $session->teacher_id == auth()->id();
        $isEnrolledStudent = $session->enrollments()
            ->where('user_id', auth()->id())
            ->where('status', 'accepted')
            ->exists();

        if (!$isTeacher && !$isEnrolledStudent) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $files = CourseFile::where('session_id', $sessionId)
            ->select('id', 'title', 'file_path', 'mime_type', 'file_size', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($files);
    }
}
