<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-3 md:p-4">
        <div class="max-w-md mx-auto">
            <div class="mb-4 md:mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Kitchen Dashboard</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Production and stock management</p>
            </div>

            <div class="space-y-3 md:space-y-4">
                <Link
                    href="/kitchen/make-yoghurt"
                    class="bg-white rounded-lg shadow-sm p-3 md:p-4 border border-gray-200 flex items-center hover:shadow-md transition-shadow"
                >
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm md:text-base">Make Yoghurt</h3>
                        <p class="text-gray-600 text-xs md:text-sm">Create new yoghurt batch</p>
                    </div>
                </Link>

                <Link
                    href="/kitchen/send-stock"
                    class="bg-white rounded-lg shadow-sm p-3 md:p-4 border border-gray-200 flex items-center hover:shadow-md transition-shadow"
                >
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 md:mr-4">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm md:text-base">Send Stock</h3>
                        <p class="text-gray-600 text-xs md:text-sm">Transfer stock to branches</p>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>
