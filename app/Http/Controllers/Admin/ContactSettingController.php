<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactSetting;

class ContactSettingController extends Controller
{
    public function index()
    {
        $settings = ContactSetting::orderBy('created_at', 'desc')->take(10)->get();
        $title = "Contact Settings";
        return view('admin.contact-settings.index', compact('settings', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:contact_settings,key',
            'value' => 'nullable|string',
        ]);

        ContactSetting::create([
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.contact-settings.index')
                         ->with('success', 'Contact setting berhasil ditambahkan.');
    }

    public function edit(ContactSetting $contactSetting)
    {
        $title = "Edit Contact Setting";
        return view('admin.contact-settings.edit', [
            'setting' => $contactSetting,
            'title' => $title
        ]);
    }

    public function update(Request $request, ContactSetting $contactSetting)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:contact_settings,key,' . $contactSetting->id,
            'value' => 'nullable|string',
        ]);

        $contactSetting->update([
            'key' => $request->key,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.contact-settings.index')
                         ->with('success', 'Contact setting berhasil diperbarui.');
    }

    public function destroy(ContactSetting $contactSetting)
    {
        $contactSetting->delete();
        return redirect()->route('admin.contact-settings.index')
                         ->with('success', 'Contact setting berhasil dihapus.');
    }
}