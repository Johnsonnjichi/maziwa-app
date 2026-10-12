<?php

use App\Models\User;

it('allows an admin to view and update the role permissions matrix', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'branch_id' => null,
    ]);

    $response = $this->actingAs($admin)->get('/admin/permissions');

    $response->assertOk()
        ->assertSee('Admin\\/Permissions')
        ->assertSee('permissionLabels');

    $payload = [
        'roles' => [
            'manager' => [
                'view_branches',
                'view_branch_details',
                'manage_items_prices',
                'record_sales',
                'add_milk_inventory',
                'add_expenses',
                'record_wastage',
                'end_of_day',
                'make_yoghurt',
                'send_stock',
                'confirm_arrival',
            ],
            'worker' => [
                'record_sales',
                'add_milk_inventory',
                'add_expenses',
                'record_wastage',
                'end_of_day',
            ],
        ],
    ];

    $this->actingAs($admin)
        ->post('/admin/permissions', $payload)
        ->assertRedirect('/admin/permissions')
        ->assertSessionHas('success');

    expect(config('permissions.roles.manager'))->toContain('record_sales')
        ->and(config('permissions.roles.manager'))->not->toContain('manage_users')
        ->and(config('permissions.roles.worker'))->toContain('record_sales');
});
