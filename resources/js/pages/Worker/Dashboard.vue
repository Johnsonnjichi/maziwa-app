<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-3 md:p-4">
        <div class="max-w-md mx-auto">
            <div class="mb-4 md:mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Worker Dashboard</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Quick actions for daily tasks</p>
            </div>

            <div class="space-y-3 md:space-y-4">
                <Link
                    href="/worker/record-sale"
                    class="bg-white rounded-lg shadow-sm p-3 md:p-4 border border-gray-200 flex items-center hover:shadow-md transition-shadow"
                >
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm md:text-base">Record Sale</h3>
                        <p class="text-gray-600 text-xs md:text-sm">Process a new sale</p>
                    </div>
                </Link>

                <Link
                    href="/worker/milk-received"
                    class="bg-white rounded-lg shadow-sm p-3 md:p-4 border border-gray-200 flex items-center hover:shadow-md transition-shadow"
                >
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm md:text-base">Milk Received</h3>
                        <p class="text-gray-600 text-xs md:text-sm">Record milk inventory</p>
                    </div>
                </Link>

                <Link
                    href="/worker/add-expense"
                    class="bg-white rounded-lg shadow-sm p-3 md:p-4 border border-gray-200 flex items-center hover:shadow-md transition-shadow"
                >
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm md:text-base">Add Expense</h3>
                        <p class="text-gray-600 text-xs md:text-sm">Record daily expenses</p>
                    </div>
                </Link>

                <Link
                    href="/worker/wastage"
                    class="bg-white rounded-lg shadow-sm p-3 md:p-4 border border-gray-200 flex items-center hover:shadow-md transition-shadow"
                >
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm md:text-base">Record Wastage</h3>
                        <p class="text-gray-600 text-xs md:text-sm">Track product wastage</p>
                    </div>
                </Link>

                <Link
                    href="/worker/end-of-day"
                    class="bg-white rounded-lg shadow-sm p-3 md:p-4 border border-gray-200 flex items-center hover:shadow-md transition-shadow"
                >
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm md:text-base">End of Day</h3>
                        <p class="text-gray-600 text-xs md:text-sm">Complete daily closeout</p>
                    </div>
                </Link>

                <Link
                    href="/worker/close-the-day"
                    class="bg-white rounded-lg shadow-sm p-3 md:p-4 border border-gray-200 flex items-center hover:shadow-md transition-shadow"
                >
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm md:text-base">Close the Day</h3>
                        <p class="text-gray-600 text-xs md:text-sm">View today's closeout</p>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>
