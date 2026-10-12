<?php

use App\Models\User;

it('keeps only the three supported roles and gives manager kitchen access without user config rights', function () {
    $manager = User::factory()->create(['role' => 'manager', 'branch_id' => null]);

    expect($manager->isAdmin())->toBeFalse()
        ->and($manager->isManager())->toBeTrue()
        ->and($manager->isWorker())->toBeFalse()
        ->and($manager->hasPermission('record_sales'))->toBeTrue()
        ->and($manager->hasPermission('make_yoghurt'))->toBeTrue()
        ->and($manager->hasPermission('send_stock'))->toBeTrue()
        ->and($manager->hasPermission('manage_users'))->toBeFalse()
        ->and($manager->hasPermission('system_config'))->toBeFalse();
});

it('allows administrators to grant and revoke permissions dynamically per role', function () {
    $manager = User::factory()->create(['role' => 'manager', 'branch_id' => null]);

    $permissions = config('permissions.roles.manager');
    $permissions[] = 'custom_permission';
    config()->set('permissions.roles.manager', $permissions);

    expect($manager->hasPermission('custom_permission'))->toBeTrue();

    config()->set('permissions.roles.manager', array_values(array_diff($permissions, ['custom_permission'])));

    expect($manager->hasPermission('custom_permission'))->toBeFalse();
});
