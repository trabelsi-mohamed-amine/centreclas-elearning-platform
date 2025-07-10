<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Session; // Import the Session model

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        Log::info('TeacherController@index method invoked');

        $search = $request->input('search');
        $teachers = User::where('role_id', 2)
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                          ->orWhere('email', 'like', "%$search%");
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('formateurad', compact('teachers'));
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

        // Create a new user with role_id = 2 (teacher)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'cin' => $request->cin,
            'telephone' => $request->telephone,
            'date_of_birth' => $request->date_of_birth,
            'role_id' => 2,
        ]);

        return redirect()->route('teachers.index')->with('success', "Le formateur a été ajouté avec succès.");
    }

    public function destroy($id)
    {
        // Find the user with role_id = 2 (teacher) and delete
        $teacher = User::where('id', $id)->where('role_id', 2)->firstOrFail();
        $name = $teacher->name;
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', "Le formateur '$name' a été supprimé avec succès.");
    }

    public function edit($id)
    {
        // Find the teacher with role_id = 2 (teacher)
        $teacher = User::where('id', $id)->where('role_id', 2)->firstOrFail();

        // Redirect to the edit view with the teacher data
        return view('edit-teacher', compact('teacher'));
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

        // Find the teacher with role_id = 2 (teacher) and update
        $teacher = User::where('id', $id)->where('role_id', 2)->firstOrFail();
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'cin' => $request->cin,
            'telephone' => $request->telephone,
            'date_of_birth' => $request->date_of_birth,
        ]);

        // If password is provided, update it
        if ($request->filled('password')) {
            $teacher->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('teachers.index')->with('success', "Les informations du formateur '{$teacher->name}' ont été mises à jour avec succès.");
    }

    public function teacherInterface()
    {
        // Fetch sessions associated with the logged-in teacher
        $sessions = Session::where('teacher_id', auth()->id())->get();

        // Pass the sessions to the view
        return view('teacher-interface', compact('sessions'));
    }
}
