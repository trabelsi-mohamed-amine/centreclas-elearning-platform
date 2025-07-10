<?php

namespace App\Http\Controllers;

use App\Models\AdminMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMessageController extends Controller
{
    // Display the admin messages
    public function index()
    {
        $messages = AdminMessage::latest()->get(); // Fetch all messages sorted from newest to oldest
        return view('admin.messages', compact('messages'));
    }

    // Store or update the admin message
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        AdminMessage::updateOrCreate(
            ['id' => 1], // Assuming a single message
            [
                'message' => $request->message,
                'admin_id' => Auth::id(),
            ]
        );

        return redirect()->back()->with('success', 'Message updated successfully!');
    }
}
