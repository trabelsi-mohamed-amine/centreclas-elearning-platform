<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('account-settings', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
            'cin' => 'required|string|max:20',
            'telephone' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Track what was changed to create a more specific success message
        $changes = [];

        if ($user->isDirty('name')) {
            $changes[] = 'nom';
        }

        if ($user->isDirty('email')) {
            $changes[] = 'adresse email';
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
            $changes[] = 'mot de passe';
        }

        $user->cin = $request->input('cin');
        if ($user->isDirty('cin')) {
            $changes[] = 'CIN';
        }

        $user->telephone = $request->input('telephone');
        if ($user->isDirty('telephone')) {
            $changes[] = 'numéro de téléphone';
        }

        $user->date_of_birth = $request->input('date_of_birth');
        if ($user->isDirty('date_of_birth')) {
            $changes[] = 'date de naissance';
        }

        $user->save();

        // Create a detailed success message
        if (count($changes) > 0) {
            $successMessage = 'Votre compte a été mis à jour avec succès (';
            $successMessage .= implode(', ', $changes);
            $successMessage .= ').';
        } else {
            $successMessage = 'Aucune modification n\'a été apportée à votre compte.';
        }

        return redirect()->route('welcome')->with('success', $successMessage);
    }
}
