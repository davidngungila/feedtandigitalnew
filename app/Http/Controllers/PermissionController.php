<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('group_name')->orderBy('name')->get();
        $grouped = $permissions->groupBy('group_name');
        return response()->json(['success' => true, 'permissions' => $permissions, 'grouped' => $grouped]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
            'slug' => 'required|string|max:255|unique:permissions',
            'description' => 'nullable|string',
            'group_name' => 'nullable|string|max:255'
        ]);

        $permission = Permission::create($data);
        return response()->json(['success' => true, 'permission' => $permission]);
    }

    public function show(Permission $permission)
    {
        return response()->json(['success' => true, 'permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => 'string|max:255|unique:permissions,name,' . $permission->id,
            'slug' => 'string|max:255|unique:permissions,slug,' . $permission->id,
            'description' => 'nullable|string',
            'group_name' => 'nullable|string|max:255'
        ]);

        $permission->update($data);
        return response()->json(['success' => true, 'permission' => $permission]);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['success' => true]);
    }
}
