<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions', 'users' => function($query) {
            $query->where('is_active', true);
        }])->get();
        return response()->json(['success' => true, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'slug' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $role = Role::create($data);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return response()->json(['success' => true, 'role' => $role->load(['permissions', 'users' => function($query) {
            $query->where('is_active', true);
        }])]);
    }

    public function show(Role $role)
    {
        return response()->json(['success' => true, 'role' => $role->load(['permissions', 'users' => function($query) {
            $query->where('is_active', true);
        }])]);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'string|max:255|unique:roles,name,' . $role->id,
            'slug' => 'string|max:255|unique:roles,slug,' . $role->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $role->update($data);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return response()->json(['success' => true, 'role' => $role->load(['permissions', 'users' => function($query) {
            $query->where('is_active', true);
        }])]);
    }

    public function destroy(Role $role)
    {
        if ($role->is_system) {
            return response()->json(['success' => false, 'message' => 'Cannot delete system role'], 403);
        }

        $role->delete();
        return response()->json(['success' => true]);
    }
}
