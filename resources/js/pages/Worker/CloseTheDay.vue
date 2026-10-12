<script setup lang="ts">
defineProps<{
    closeout: {
        id: number
        closeout_date: string
        opening_balance: number
        total_sales: number
        cash_on_hand: number
        total_expenses: number
        net_cash: number
        expected_cash: number
        variance: number
        notes: string | null
    } | null
}>()
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-3 md:p-4">
        <div class="max-w-md mx-auto">
            <div class="mb-4 md:mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Close the Day</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Today's closeout summary</p>
            </div>

            <div v-if="closeout" class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Date:</span>
                        <span class="font-medium text-gray-900">{{ closeout.closeout_date }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Opening Balance:</span>
                        <span class="font-medium text-gray-900">KES {{ closeout.opening_balance.toFixed(2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Sales:</span>
                        <span class="font-medium text-gray-900">KES {{ closeout.total_sales.toFixed(2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Cash on Hand:</span>
                        <span class="font-medium text-gray-900">KES {{ closeout.cash_on_hand.toFixed(2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Expenses:</span>
                        <span class="font-medium text-gray-900">KES {{ closeout.total_expenses.toFixed(2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Net Cash:</span>
                        <span class="font-medium text-gray-900">KES {{ closeout.net_cash.toFixed(2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Expected Cash:</span>
                        <span class="font-medium text-gray-900">KES {{ closeout.expected_cash.toFixed(2) }}</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-gray-200">
                        <span class="text-gray-600 font-medium">Variance:</span>
                        <span
                            class="font-bold"
                            :class="closeout.variance >= 0 ? 'text-green-600' : 'text-red-600'"
                        >
                            KES {{ closeout.variance.toFixed(2) }}
                        </span>
                    </div>
                    <div v-if="closeout.notes" class="pt-3 border-t border-gray-200">
                        <span class="text-gray-600">Notes:</span>
                        <p class="text-gray-900 mt-1">{{ closeout.notes }}</p>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-green-50 rounded-md">
                    <p class="text-green-800 text-sm font-medium">Day closed successfully!</p>
                </div>
            </div>

            <div v-else class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                <p class="text-gray-600 text-center">No closeout recorded for today yet.</p>
            </div>
        </div>
    </div>
</template>
