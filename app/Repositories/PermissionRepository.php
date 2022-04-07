<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    /**
     * Get All Permissions Grouped By Module name and get inested permissions with selected or not with role
     *
     */
    public function getAllPermissionsGroupedByModule($role = null)
    {
        return Permission::whereNotNull('module')->groupBy('module')->get()->map(function($item) use($role) {
            $item->permissions = Permission::whereModule($item->module)->select('id', 'name', 'title')->get()->map(function($permission) use($role){
                $permission->is_selected = optional($role)->hasPermissionTo($permission->name);
                return $permission->only(['id', 'name', 'title', 'is_selected']);
            });
            return $item->only(['id', 'name', 'title', 'module', 'permissions']);
        });
    }

    /**
     * Sync Permissions
     *
     */
    public function syncPermissions($role, $permissions)
    {
        $role->syncPermissions($permissions);
    }
}
