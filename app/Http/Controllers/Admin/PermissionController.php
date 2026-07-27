<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
{
    $search = request('search');

    $permissions = \Spatie\Permission\Models\Permission::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('guard_name', 'like', '%' . $search . '%');
        })
        ->orderBy('name')
        ->paginate(10)
        ->withQueryString();

    return view('admin.permissions.index', compact('permissions', 'search'));
}

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group' => ['required', 'string', 'max:50'],
            'action' => ['required', 'string', 'max:50'],
        ], [
            'group.required' => 'Group permission wajib diisi.',
            'action.required' => 'Aksi permission wajib diisi.',
        ]);

        $permissionName = strtolower($validated['group']) . '.' . strtolower($validated['action']);

        $request->merge([
            'name' => $permissionName,
        ]);

        $request->validate([
            'name' => ['unique:permissions,name'],
        ], [
            'name.unique' => 'Permission sudah ada.',
        ]);

        Permission::create([
            'name' => $permissionName,
            'guard_name' => 'web',
        ]);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission berhasil ditambahkan.');
    }

    public function edit(Permission $permission)
    {
        $parts = explode('.', $permission->name);

        $group = $parts[0] ?? '';
        $action = $parts[1] ?? '';

        return view('admin.permissions.edit', compact('permission', 'group', 'action'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'group' => ['required', 'string', 'max:50'],
            'action' => ['required', 'string', 'max:50'],
        ], [
            'group.required' => 'Group permission wajib diisi.',
            'action.required' => 'Aksi permission wajib diisi.',
        ]);

        $permissionName = strtolower($validated['group']) . '.' . strtolower($validated['action']);

        $request->merge([
            'name' => $permissionName,
        ]);

        $request->validate([
            'name' => [
                Rule::unique('permissions', 'name')->ignore($permission->id),
            ],
        ], [
            'name.unique' => 'Permission sudah ada.',
        ]);

        $permission->update([
            'name' => $permissionName,
            'guard_name' => 'web',
        ]);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', 'Permission berhasil diperbarui.');
    }

   public function destroy(Permission $permission)
{
    if ($permission->roles()->count() > 0) {
        return redirect()
            ->route('admin.permissions.index')
            ->with('error', 'Permission tidak bisa dihapus karena masih digunakan oleh role.');
    }

    $permission->delete();

    return redirect()
        ->route('admin.permissions.index')
        ->with('success', 'Permission berhasil dihapus.');
}
}