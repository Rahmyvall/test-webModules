<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModuleApiController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Modules retrieved successfully',
            'data' => ModuleResource::collection($modules),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:modules,name',
            'display_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'version' => 'nullable|string|max:50',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'installed_at' => 'nullable|date',
        ]);

        $module = Module::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Module created successfully',
            'data' => new ModuleResource($module),
        ], 201);
    }

    public function show($id)
    {
        $module = Module::find($id);

        if (!$module) {
            return response()->json([
                'success' => false,
                'message' => 'Module not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new ModuleResource($module),
        ]);
    }

    public function update(Request $request, $id)
    {
        $module = Module::find($id);

        if (!$module) {
            return response()->json([
                'success' => false,
                'message' => 'Module not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('modules', 'name')->ignore($module->id)],
            'display_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'version' => 'nullable|string|max:50',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'installed_at' => 'nullable|date',
        ]);

        $module->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Module updated successfully',
            'data' => new ModuleResource($module),
        ]);
    }

    public function destroy($id)
    {
        $module = Module::find($id);

        if (!$module) {
            return response()->json([
                'success' => false,
                'message' => 'Module not found'
            ], 404);
        }

        $module->delete();

        return response()->json([
            'success' => true,
            'message' => 'Module deleted successfully'
        ]);
    }
}