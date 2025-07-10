<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Formation::query();

        // Check if a search term is provided
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $formation = $query->orderBy('id', 'desc')->get();

        return view('formation.index', compact('formation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Formation::create($validated);

        return redirect()->route('formation.index')->with('success', 'Formation action completed successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $formation = Formation::findOrFail($id);
        return view('formation.show', compact('formation'));
    }

    /**
     * Display the sessions related to a specific formation.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\View\View
     */
    public function showSessions(Formation $formation)
    {
        $sessions = $formation->sessions; // Fetch related sessions using the relationship

        return view('sessionad', compact('formation', 'sessions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $formation = Formation::findOrFail($id);
        return view('formation.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $formation = Formation::findOrFail($id);
        $formation->update($validated);

        return redirect()->route('formation.index')->with('success', 'Formation action completed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        return redirect()->route('formation.index')->with('success', 'Formation action completed successfully.');
    }
}
