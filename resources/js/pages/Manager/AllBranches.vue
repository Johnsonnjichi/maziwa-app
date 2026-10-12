<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

defineProps<{
    branches: Array<{
        id: number
        name: string
        location: string
        manager_name: string
        is_active: boolean
        total_sales: number
        total_transactions: number
    }>
}>()
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-4 md:p-6">
        <div class="max-w-7xl mx-auto">
            <div class="mb-6 md:mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">All Branches</h1>
                <p class="text-gray-600 mt-2">Overview of all branch performance</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                <div
                    v-for="branch in branches"
                    :key="branch.id"
                    class="bg-white rounded-lg shadow-sm p-4 md:p-6 border border-gray-200"
                >
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-lg md:text-xl font-semibold text-gray-900">{{ branch.name }}</h2>
                            <p class="text-xs md:text-sm text-gray-500">{{ branch.location }}</p>
                        </div>
                        <span
                            class="px-2 py-1 text-xs font-medium rounded-full"
                            :class="branch.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                        >
                            {{ branch.is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="space-y-2 md:space-y-3">
                        <div class="flex justify-between text-xs md:text-sm">
                            <span class="text-gray-600">Manager:</span>
                            <span class="font-medium text-gray-900">{{ branch.manager_name }}</span>
                        </div>
                        <div class="flex justify-between text-xs md:text-sm">
                            <span class="text-gray-600">Total Sales (7 days):</span>
                            <span class="font-medium text-gray-900">KES {{ branch.total_sales.toFixed(2) }}</span>
                        </div>
                        <div class="flex justify-between text-xs md:text-sm">
                            <span class="text-gray-600">Transactions:</span>
                            <span class="font-medium text-gray-900">{{ branch.total_transactions }}</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <Link
                            :href="`/manager/branches/${branch.id}`"
                            class="text-blue-600 hover:text-blue-800 text-xs md:text-sm font-medium"
                        >
                            View Details →
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
