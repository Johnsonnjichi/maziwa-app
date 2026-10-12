<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

defineProps<{
    branch: {
        id: number
        name: string
        location: string
        phone: string
        manager_name: string
        is_active: boolean
    }
    recent_sales: Array<{
        id: number
        total_amount: number
        created_at: string
        user_name: string
    }>
    today_sales: number
    today_expenses: number
    monthly_sales: number
}>()
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-4 md:p-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <Link
                    href="/manager/branches"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4"
                >
                    ← Back to Branches
                </Link>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ branch.name }}</h1>
                <p class="text-gray-600 mt-1">{{ branch.location }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                    <div class="text-sm text-gray-600">Today's Sales</div>
                    <div class="text-xl font-bold text-gray-900 mt-1">KES {{ today_sales.toFixed(2) }}</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                    <div class="text-sm text-gray-600">Today's Expenses</div>
                    <div class="text-xl font-bold text-gray-900 mt-1">KES {{ today_expenses.toFixed(2) }}</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                    <div class="text-sm text-gray-600">Monthly Sales</div>
                    <div class="text-xl font-bold text-gray-900 mt-1">KES {{ monthly_sales.toFixed(2) }}</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                    <div class="text-sm text-gray-600">Status</div>
                    <div
                        class="text-xl font-bold mt-1"
                        :class="branch.is_active ? 'text-green-600' : 'text-red-600'"
                    >
                        {{ branch.is_active ? 'Active' : 'Inactive' }}
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 mb-6">
                <h3 class="font-semibold text-gray-900 mb-3">Branch Information</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Manager:</span>
                        <span class="font-medium text-gray-900">{{ branch.manager_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Phone:</span>
                        <span class="font-medium text-gray-900">{{ branch.phone }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-3">Recent Sales (Last 10)</h3>
                <div v-if="recent_sales.length > 0" class="space-y-2">
                    <div
                        v-for="sale in recent_sales"
                        :key="sale.id"
                        class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0"
                    >
                        <div>
                            <div class="text-sm font-medium text-gray-900">KES {{ sale.total_amount.toFixed(2) }}</div>
                            <div class="text-xs text-gray-500">{{ sale.created_at }}</div>
                        </div>
                        <div class="text-sm text-gray-600">{{ sale.user_name }}</div>
                    </div>
                </div>
                <div v-else class="text-gray-500 text-center py-4">No recent sales</div>
            </div>
        </div>
    </div>
</template>
