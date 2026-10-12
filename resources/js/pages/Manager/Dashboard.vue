<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-4 md:p-6">
        <div class="max-w-7xl mx-auto">
            <div class="mb-6 md:mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Manager Dashboard</h1>
                <p class="text-gray-600 mt-2">Welcome back! Here's your operations overview.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6">
                <Link href="/manager/branches" class="bg-white rounded-lg shadow-sm p-4 md:p-6 border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-base md:text-lg font-semibold text-gray-900">All Branches</h3>
                    <p class="text-gray-600 text-xs md:text-sm mt-1">View all branch performance</p>
                </Link>

                <Link href="/manager/items-prices" class="bg-white rounded-lg shadow-sm p-4 md:p-6 border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-base md:text-lg font-semibold text-gray-900">Items & Prices</h3>
                    <p class="text-gray-600 text-xs md:text-sm mt-1">Manage product pricing</p>
                </Link>

                <Link href="/sales-dashboard" class="bg-white rounded-lg shadow-sm p-4 md:p-6 border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6h18M9 19V7m0 0H7m2 0h2m-2 0V5a2 2 0 012-2h4a2 2 0 012 2v2m-8 0h8" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-base md:text-lg font-semibold text-gray-900">Sales Dashboard</h3>
                    <p class="text-gray-600 text-xs md:text-sm mt-1">Track revenue and transactions</p>
                </Link>

                <Link href="/sale-items-dashboard" class="bg-white rounded-lg shadow-sm p-4 md:p-6 border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3zm4 4h10M7 12h10M7 16h6" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-base md:text-lg font-semibold text-gray-900">Sale Items</h3>
                    <p class="text-gray-600 text-xs md:text-sm mt-1">See best-selling products</p>
                </Link>

                <Link href="/kitchen/make-yoghurt" class="bg-white rounded-lg shadow-sm p-4 md:p-6 border border-gray-200 hover:shadow-md transition-shadow md:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-rose-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8M4 7h16v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-base md:text-lg font-semibold text-gray-900">Yoghurt Production</h3>
                    <p class="text-gray-600 text-xs md:text-sm mt-1">Record yoghurt batches and production flow</p>
                </Link>

                <Link href="/kitchen/send-stock" class="bg-white rounded-lg shadow-sm p-4 md:p-6 border border-gray-200 hover:shadow-md transition-shadow md:col-span-2">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l8-8 4 4 8-8M20 12v8h-8" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-base md:text-lg font-semibold text-gray-900">Send Stock</h3>
                    <p class="text-gray-600 text-xs md:text-sm mt-1">Move stock between branches and departments</p>
                </Link>
            </div>
        </div>
    </div>
</template>
