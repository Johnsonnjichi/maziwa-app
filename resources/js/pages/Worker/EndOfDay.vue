<script setup lang="ts">
import { Form } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const props = defineProps<{
    total_sales: number
    total_expenses: number
    closeout_date: string
}>()

const openingBalance = ref(0)
const cashOnHand = ref(0)
const notes = ref('')

const netCash = computed(() => cashOnHand.value - props.total_expenses)
const expectedCash = computed(() => openingBalance.value + props.total_sales)
const variance = computed(() => netCash.value - expectedCash.value)
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-3 md:p-4">
        <div class="max-w-md mx-auto">
            <div class="mb-4 md:mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">End of Day</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Complete daily closeout</p>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 mb-4">
                <h3 class="font-semibold text-gray-900 mb-3">Today's Summary</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Sales:</span>
                        <span class="font-medium text-gray-900">KES {{ total_sales.toFixed(2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Expenses:</span>
                        <span class="font-medium text-gray-900">KES {{ total_expenses.toFixed(2) }}</span>
                    </div>
                </div>
            </div>

            <Form
                action="/worker/daily-closeouts"
                method="post"
                #default="{ errors, processing }"
            >
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 space-y-4">
                    <input type="hidden" name="closeout_date" :value="closeout_date">
                    <input type="hidden" name="total_sales" :value="total_sales">
                    <input type="hidden" name="total_expenses" :value="total_expenses">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Opening Balance (Start of Day)</label>
                        <input
                            v-model.number="openingBalance"
                            type="number"
                            name="opening_balance"
                            min="0"
                            step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cash on Hand (End of Day)</label>
                        <input
                            v-model.number="cashOnHand"
                            type="number"
                            name="cash_on_hand"
                            min="0"
                            step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div class="bg-gray-50 p-3 rounded-md space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Opening Balance:</span>
                            <span class="font-medium text-gray-900">KES {{ openingBalance.toFixed(2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Total Sales:</span>
                            <span class="font-medium text-gray-900">KES {{ total_sales.toFixed(2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Net Cash:</span>
                            <span class="font-medium text-gray-900">KES {{ netCash.toFixed(2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Expected Cash:</span>
                            <span class="font-medium text-gray-900">KES {{ expectedCash.toFixed(2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm pt-2 border-t border-gray-200">
                            <span class="text-gray-600">Variance:</span>
                            <span
                                class="font-medium"
                                :class="variance >= 0 ? 'text-green-600' : 'text-red-600'"
                            >
                                KES {{ variance.toFixed(2) }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                        <textarea
                            v-model="notes"
                            name="notes"
                            rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        :disabled="processing"
                        class="w-full py-3 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        {{ processing ? 'Processing...' : 'Complete Closeout' }}
                    </button>
                </div>
            </Form>
        </div>
    </div>
</template>
