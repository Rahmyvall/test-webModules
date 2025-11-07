<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class UserApiController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::with('role')->get();
        return response()->json(['status'=>'success','data'=>$users]);
    }

    // Show single user
    public function show($id)
    {
        $user = User::with('role')->find($id);
        if(!$user){
            return response()->json(['status'=>'error','message'=>'User not found'],404);
        }
        return response()->json(['status'=>'success','data'=>$user]);
    }

    // Create user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6',
            'role_id'=>'nullable|exists:roles,id',
            'status'=>['required',Rule::in(['active','inactive','suspended'])]
        ]);

        $user = User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password']),
            'role_id'=>$validated['role_id'] ?? null,
            'status'=>$validated['status'],
        ]);

        return response()->json(['status'=>'success','message'=>'User created','data'=>$user],201);
    }

    // Update user
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['status'=>'error','message'=>'User not found'],404);
        }

        $validated = $request->validate([
            'name'=>'required|string|max:100',
            'email'=>['required','email',Rule::unique('users')->ignore($user->id)],
            'password'=>'nullable|string|min:6',
            'role_id'=>'nullable|exists:roles,id',
            'status'=>['required',Rule::in(['active','inactive','suspended'])]
        ]);

        if(!empty($validated['password'])){
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json(['status'=>'success','message'=>'User updated','data'=>$user]);
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['status'=>'error','message'=>'User not found'],404);
        }

        $user->delete();
        return response()->json(['status'=>'success','message'=>'User deleted']);
    }


    // Export PDF
    public function exportPDF()
    {
        $users = User::with('role')->get();
        $pdf = Pdf::loadView('dashboard.admin.user.users_pdf', compact('users'));
        return $pdf->download('users.pdf');
    }
}