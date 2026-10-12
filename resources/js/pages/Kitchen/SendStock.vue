<script setup lang="ts">
import { Form } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps<{
    branches: Array<{
        id: number
        name: string
    }>
    products: Array<{
        id: number
        name: string
        unit: string
    }>
}>()

const toBranchId = ref(0)
const productId = ref(0)
const quantity = ref(1)
const transferDate = ref(new Date().toISOString().split('T')[0])
const notes = ref('')
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-3 md:p-4">
        <div class="max-w-md mx-auto">
            <div class="mb-4 md:mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Send Stock</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Transfer stock to another branch</p>
            </div>

            <Form
                action="/kitchen/stock-transfers"
                method="post"
                #default="{ errors, processing }"
            >
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Branch</label>
                        <select
                            v-model="toBranchId"
                            name="to_branch_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Select branch</option>
                            <option v-for="branch in branches" :key="branch.id" :value="branch.id">
                                {{ branch.name }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                        <select
                            v-model="productId"
                            name="product_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Select product</option>
                            <option v-for="product in products" :key="product.id" :value="product.id">
                                {{ product.name }} ({{ product.unit }})
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                        <input
                            v-model.number="quantity"
                            type="number"
                            name="quantity"
                            min="1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Transfer Date</label>
                        <input
                            v-model="transferDate"
                            type="date"
                            name="transfer_date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
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
                        {{ processing ? 'Creating...' : 'Create Transfer' }}
                    </button>
                </div>
            </Form>
        </div>
    </div>
</template>
