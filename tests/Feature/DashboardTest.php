<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertOk();
});

test('workers have the daily task permissions that appear in the sidebar', function () {
    $worker = User::factory()->create(['role' => 'worker', 'branch_id' => null]);

    expect($worker->isWorker())->toBeTrue()
        ->and($worker->hasPermission('record_sales'))->toBeTrue()
        ->and($worker->hasPermission('add_milk_inventory'))->toBeTrue()
        ->and($worker->hasPermission('add_expenses'))->toBeTrue()
        ->and($worker->hasPermission('record_wastage'))->toBeTrue()
        ->and($worker->hasPermission('end_of_day'))->toBeTrue();
});
