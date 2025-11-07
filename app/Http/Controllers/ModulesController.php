<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class ModulesController extends Controller
{
    // Menampilkan semua modules
    public function index()
    {
        $modules = Module::all();
        $title = 'Modules Management';
        return view('dashboard.admin.modules.index', compact('modules', 'title'));
    }

    // Menampilkan form create module
    public function create()
    {
        $title = 'Create Module';
        return view('dashboard.admin.modules.create', compact('title'));
    }

    // Simpan module baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:modules,name',
            'display_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'version' => 'nullable|string|max:50',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'installed_at' => 'nullable|date',
        ]);

        Module::create($validated);

        return redirect()->route('admin.modules.index')->with('success', 'Module created successfully!');
    }

    // Menampilkan detail module
    public function show($id)
    {
        $module = Module::findOrFail($id);
        $title = 'Module Detail';
        return view('dashboard.admin.modules.show', compact('module', 'title'));
    }

    // Menampilkan form edit module
    public function edit($id)
    {
        $module = Module::findOrFail($id);
        $title = 'Edit Module';
        return view('dashboard.admin.modules.edit', compact('module', 'title'));
    }

    // Update module
    public function update(Request $request, $id)
    {
        $module = Module::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('modules')->ignore($module->id)],
            'display_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'version' => 'nullable|string|max:50',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'installed_at' => 'nullable|date',
        ]);

        $module->update($validated);

        return redirect()->route('admin.modules.index')->with('success', 'Module updated successfully!');
    }

    // Hapus module
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()->route('admin.modules.index')->with('success', 'Module deleted successfully!');
    }

    // Export modules ke PDF
    public function exportPDF()
    {
        $modules = Module::all();
        $title = 'Modules PDF Export';
        $pdf = Pdf::loadView('dashboard.admin.modules.modules_pdf', compact('modules', 'title'));
        return $pdf->download('modules.pdf');
    }

    // Print view HTML
    public function print()
    {
        $modules = Module::all();
        $title = 'Modules Print View';
        return view('dashboard.admin.modules.modules_print', compact('modules', 'title'));
    }
}