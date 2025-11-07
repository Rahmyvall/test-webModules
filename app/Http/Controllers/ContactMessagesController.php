<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactMessagesController extends Controller
{
    // Tampilkan semua pesan
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        $title = 'Contact Messages';
        return view('dashboard.admin.contact-messages.index', compact('messages', 'title'));
    }

    // Simpan pesan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'status' => ['required', Rule::in(['new','replied','archived'])],
            'is_read' => 'nullable|boolean',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message created successfully!');
    }

    // Tampilkan detail pesan
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        $title = 'Message Detail';
        return view('dashboard.admin.contact-messages.show', compact('message', 'title'));
    }

    // Tampilkan form edit pesan
    public function edit($id)
    {
        $message = ContactMessage::findOrFail($id);
        $title = 'Edit Message';
        return view('dashboard.admin.contact-messages.edit', compact('message', 'title'));
    }

    // Update pesan
    public function update(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['new','replied','archived'])],
            'is_read' => 'required|boolean',
        ]);

        $message->update($validated);

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message updated successfully!');
    }

    // Hapus pesan
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete(); // Soft delete jika di model pakai SoftDeletes

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message deleted successfully!');
    }
}