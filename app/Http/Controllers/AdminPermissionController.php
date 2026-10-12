<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminPermissionController extends Controller
{
    public function index(): Response
    {
        $config = config('permissions', [
            'permissions' => [],
            'roles' => [],
        ]);

        $roles = collect(array_keys($config['roles']))
            ->map(function (string $role) use ($config): array {
                $permissions = array_values($config['roles'][$role] ?? []);

                return [
                    'name' => $role,
                    'label' => ucfirst($role),
                    'permissions' => $permissions,
                    'is_admin' => $role === 'admin',
                ];
            })
            ->values()
            ->all();

        return Inertia::render('Admin/Permissions', [
            'permissionLabels' => $config['permissions'] ?? [],
            'roles' => $roles,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $availablePermissions = array_keys(config('permissions.permissions', []));
        $rolesToEdit = ['manager', 'worker'];

        $payload = $request->input('roles', []);
        $configPath = base_path('config/permissions.php');
        $config = require $configPath;

        foreach ($rolesToEdit as $role) {
            $selected = $payload[$role] ?? [];
            $normalized = array_values(array_intersect(array_unique($selected), $availablePermissions));
            $config['roles'][$role] = $normalized;
        }

        $config['roles']['admin'] = array_values(array_unique(array_merge(
            $config['roles']['admin'] ?? [],
            ['manage_permissions', 'system_config']
        )));

        $fileContents = "<?php\n\nreturn " . var_export($config, true) . ";\n";
        file_put_contents($configPath, $fileContents);

        config()->set('permissions.roles', $config['roles']);

        return to_route('admin.permissions')->with('success', 'Permission matrix updated successfully.');
    }
}
