<script setup lang="ts">
import { Form } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps<{
    products: Array<{
        id: number
        name: string
        price: number
        unit: string
    }>
}>()

const items = ref<Array<{ product_id: number; quantity: number }>>([])
const cashReceived = ref(0)
const paymentMethod = ref('cash')
const notes = ref('')

const addItem = () => {
    items.value.push({ product_id: 0, quantity: 1 })
}

const removeItem = (index: number) => {
    items.value.splice(index, 1)
}

const totalAmount = () => {
    return items.value.reduce((sum, item) => {
        const product = props.products.find(p => p.id === item.product_id)
        return sum + (product ? product.price * item.quantity : 0)
    }, 0)
}

const change = () => {
    return Math.max(0, cashReceived.value - totalAmount())
}
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-3 md:p-4">
        <div class="max-w-md mx-auto">
            <div class="mb-4 md:mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Record a Sale</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Add products and complete the sale</p>
            </div>

            <Form
                action="/worker/sales"
                method="post"
                #default="{ errors, processing }"
            >
                <div class="space-y-4">
                    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                        <h3 class="font-semibold text-gray-900 mb-3">Products</h3>

                        <div v-for="(item, index) in items" :key="index" class="mb-3 pb-3 border-b border-gray-100 last:border-0">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                                    <select
                                        v-model="item.product_id"
                                        name="items[]product_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >
                                        <option value="">Select product</option>
                                        <option v-for="product in products" :key="product.id" :value="product.id">
                                            {{ product.name }} - KES {{ Number(product.price).toFixed(2) }}
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                    <input
                                        v-model.number="item.quantity"
                                        type="number"
                                        :name="`items[${index}][quantity]`"
                                        min="1"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >
                                </div>
                            </div>
                            <button
                                type="button"
                                @click="removeItem(index)"
                                class="mt-2 text-red-600 text-sm hover:text-red-800"
                            >
                                Remove
                            </button>
                        </div>

                        <button
                            type="button"
                            @click="addItem"
                            class="w-full py-2 px-4 bg-blue-50 text-blue-600 rounded-md hover:bg-blue-100 font-medium"
                        >
                            + Add Product
                        </button>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                        <h3 class="font-semibold text-gray-900 mb-3">Payment</h3>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Total Amount</label>
                                <div class="text-2xl font-bold text-gray-900">KES {{ totalAmount().toFixed(2) }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Cash Received</label>
                                <input
                                    v-model.number="cashReceived"
                                    type="number"
                                    name="cash_received"
                                    min="0"
                                    step="0.01"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Change</label>
                                <div class="text-xl font-semibold text-green-600">KES {{ change().toFixed(2) }}</div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                                <select
                                    v-model="paymentMethod"
                                    name="payment_method"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <option value="cash">Cash</option>
                                    <option value="mobile">Mobile Money</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                                <textarea
                                    v-model="notes"
                                    name="notes"
                                    rows="2"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                ></textarea>
                            </div>
                        </div>
                    </div>

                    <button
                        type="submit"
                        :disabled="processing || items.length === 0"
                        class="w-full py-3 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        {{ processing ? 'Processing...' : 'Complete Sale' }}
                    </button>
                </div>
            </Form>
        </div>
    </div>
</template>
