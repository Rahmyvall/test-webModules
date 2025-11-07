<?php

namespace App\Http\Controllers;

use App\Models\ModuleSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class ModuleSettingsController extends Controller
{
    // Menampilkan semua module settings
    public function index()
    {
        $moduleSettings = ModuleSetting::all();
        $title = 'Module Settings Management';
        return view('dashboard.admin.module-settings.index', compact('moduleSettings', 'title'));
    }

    // Menampilkan form create module setting
    public function create()
    {
        $title = 'Create Module Setting';
        return view('dashboard.admin.module-settings.create', compact('title'));
    }

    // Simpan module setting baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_name' => 'required|string|max:100',
            'key' => [
                'required',
                'string',
                'max:150',
                Rule::unique('module_settings')->where(function ($query) use ($request) {
                    return $query->where('module_name', $request->module_name);
                }),
            ],
            'value' => 'nullable|string',
        ]);

        ModuleSetting::create($validated);

        return redirect()->route('admin.module-settings.index')->with('success', 'Module setting created successfully!');
    }

    // Menampilkan detail module setting
    public function show($id)
    {
        $moduleSetting = ModuleSetting::findOrFail($id);
        $title = 'Module Setting Detail';
        return view('dashboard.admin.module-settings.show', compact('moduleSetting', 'title'));
    }

    // Menampilkan form edit module setting
    public function edit($id)
    {
        $moduleSetting = ModuleSetting::findOrFail($id);
        $title = 'Edit Module Setting';
        return view('dashboard.admin.module-settings.edit', compact('moduleSetting', 'title'));
    }

    // Update module setting
    public function update(Request $request, $id)
    {
        $moduleSetting = ModuleSetting::findOrFail($id);

        $validated = $request->validate([
            'module_name' => 'required|string|max:100',
            'key' => [
                'required',
                'string',
                'max:150',
                Rule::unique('module_settings')->ignore($moduleSetting->id)->where(function ($query) use ($request) {
                    return $query->where('module_name', $request->module_name);
                }),
            ],
            'value' => 'nullable|string',
        ]);

        $moduleSetting->update($validated);

        return redirect()->route('admin.module-settings.index')->with('success', 'Module setting updated successfully!');
    }

    // Hapus module setting
    public function destroy($id)
    {
        $moduleSetting = ModuleSetting::findOrFail($id);
        $moduleSetting->delete();

        return redirect()->route('admin.module-settings.index')->with('success', 'Module setting deleted successfully!');
    }

    // Export module settings ke PDF
    public function exportPDF()
    {
        $moduleSettings = ModuleSetting::all();
        $title = 'Module Settings PDF Export';
        $pdf = Pdf::loadView('dashboard.admin.module-settings.module-settingspdf', compact('moduleSettings', 'title'));
        return $pdf->download('module_settings.pdf');
    }

    // Print view HTML
    public function print()
    {
        $moduleSettings = ModuleSetting::all();
        $title = 'Module Settings Print View';
        return view('dashboard.admin.module-settings.module-settingsprint', compact('moduleSettings', 'title'));
    }
}