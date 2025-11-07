<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // ✅ gunakan Role, bukan Roles
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Models\Roles;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::with('roles')->get(); // pastikan relasi 'role' di User model ada
        $title = 'Users Management';
        return view('dashboard.admin.user.index', compact('users', 'title'));
    }

    // Menampilkan form create
    public function create()
    {
        $roles = Roles::all(); // ✅ gunakan Role
        $title = 'Create User';
        return view('dashboard.admin.user.create', compact('roles', 'title'));
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'nullable|exists:roles,id',
            'status' => ['required', Rule::in(['active','inactive','suspended'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    // Menampilkan detail user
    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $title = 'User Detail';
        return view('dashboard.admin.user.show', compact('user', 'title'));
    }


    // Menampilkan form edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Roles::all(); // ✅ gunakan Role
        $title = 'Edit User';
        return view('dashboard.admin.user.edit', compact('user', 'roles', 'title'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required','email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
            'role_id' => 'nullable|exists:roles,id',
            'status' => ['required', Rule::in(['active','inactive','suspended'])],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    // Export PDF
    public function exportPDF()
    {
        $users = User::with('roles')->get();
        $title = 'Users PDF Export';
        $pdf = PDF::loadView('dashboard.admin.user.users_pdf', compact('users', 'title'));
        return $pdf->download('users.pdf');
    }

    // Print view HTML
    public function print()
    {
        $users = User::with('roles')->get();
        $title = 'Users Print View';
        return view('dashboard.admin.user.users_print', compact('users', 'title'));
    }
}