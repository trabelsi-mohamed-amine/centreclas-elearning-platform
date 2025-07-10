<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User; // Use User model to fetch formateurs
use Illuminate\Support\Facades\PDF;
use App\Models\Enrollment;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        Log::info('StudentController@index method invoked');

        $search = $request->input('search');
        $students = User::where('role_id', 3)
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                          ->orWhere('email', 'like', "%$search%");
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('etudiantad', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'cin' => 'required|string|max:8|unique:users,cin',
            'telephone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
        ]);

        Log::info('Request data:', $request->all());

        // Create a new user with role_id = 3 (student)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'cin' => $request->cin,
            'telephone' => $request->telephone,
            'date_of_birth' => $request->date_of_birth,
            'role_id' => 3,
        ]);

        return redirect()->route('students.index')->with('success', "L'apprenant a été ajouté avec succès.");
    }

    public function destroy($id)
    {
        // Find the user with role_id = 3 (student) and delete
        $student = User::where('id', $id)->where('role_id', 3)->firstOrFail();
        $name = $student->name;
        $student->delete();

        return redirect()->route('students.index')->with('success', "L'apprenant '$name' a été supprimé avec succès.");
    }

    public function edit($id)
    {
        // Find the student with role_id = 3 (student)
        $student = User::where('id', $id)->where('role_id', 3)->firstOrFail();

        // Redirect to the edit view with the student data
        return view('edit-student', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'cin' => 'required|string|max:8|unique:users,cin,' . $id,
            'telephone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
        ]);

        // Find the student with role_id = 3 (student) and update
        $student = User::where('id', $id)->where('role_id', 3)->firstOrFail();
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'cin' => $request->cin,
            'telephone' => $request->telephone,
            'date_of_birth' => $request->date_of_birth,
        ]);

        // If password is provided, update it
        if ($request->filled('password')) {
            $student->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('students.index')->with('success', "Les informations de l'apprenant '{$student->name}' ont été mises à jour avec succès.");
    }

    public function studentInterface()
    {
        // Logic for the student interface
        return view('student-interface');
    }

    public function downloadTimetable()
    {
        $user = auth()->user();

        // Fetch enrolled sessions for the authenticated student
        $enrollments = Enrollment::where('user_id', $user->id)->with('session')->get();

        // Generate a PDF with the timetable details
        $pdf = PDF::loadView('timetable', ['enrollments' => $enrollments]);

        // Return the PDF as a download
        return $pdf->download('timetable.pdf');
    }

    public function listStudents()
    {
        $students = User::where('role_id', 3)->get(); // Fetch all users with role_id = 3 (students)
        return view('students.list', compact('students'));
    }
}
