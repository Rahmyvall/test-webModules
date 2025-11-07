<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class RolesController extends Controller
{
    // Menampilkan semua roles
    public function index()
    {
        $roles = Roles::all();
        $title = 'Roles Management';
        return view('dashboard.admin.roles.index', compact('roles', 'title'));
    }

    // Menampilkan form create role
    public function create()
    {
        $title = 'Create Role';
        return view('dashboard.admin.roles.create', compact('title'));
    }

    // Simpan role baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
            'display_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(['active','inactive'])],
        ]);

        Roles::create($validated);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully!');
    }

    // Menampilkan detail role
    public function show($id)
    {
        $role = Roles::findOrFail($id);
        $title = 'Role Detail';
        return view('dashboard.admin.roles.show', compact('role', 'title'));
    }

    // Menampilkan form edit role
    public function edit($id)
    {
        $role = Roles::findOrFail($id);
        $title = 'Edit Role';
        return view('dashboard.admin.roles.edit', compact('role', 'title'));
    }

    // Update role
    public function update(Request $request, $id)
    {
        $role = Roles::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required','string','max:50', Rule::unique('roles')->ignore($role->id)],
            'display_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(['active','inactive'])],
        ]);

        $role->update($validated);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully!');
    }

    // Hapus role
    public function destroy($id)
    {
        $role = Roles::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully!');
    }

    // Export roles ke PDF
    public function exportPDF()
    {
        $roles = Roles::all();
        $title = 'Roles PDF Export';
        $pdf = Pdf::loadView('dashboard.admin.roles.roles_pdf', compact('roles', 'title'));
        return $pdf->download('roles.pdf');
    }
      

    // Print view HTML
    public function print()
    {
        $roles = Roles::all();
        $title = 'Roles Print View';
        return view('dashboard.admin.roles.roles_print', compact('roles', 'title'));
    }
}