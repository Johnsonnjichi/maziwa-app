<script setup lang="ts">
import { Form } from '@inertiajs/vue3'
import { ref } from 'vue'

const milkQuantityLiters = ref(0)
const flavor = ref('')
const productionDate = ref(new Date().toISOString().split('T')[0])
const notes = ref('')
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-3 md:p-4">
        <div class="max-w-md mx-auto">
            <div class="mb-4 md:mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Make Yoghurt</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Create a new yoghurt batch</p>
            </div>

            <Form
                action="/kitchen/yoghurt-batches"
                method="post"
                #default="{ errors, processing }"
            >
                <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Milk Quantity (Liters)</label>
                        <input
                            v-model.number="milkQuantityLiters"
                            type="number"
                            name="milk_quantity_liters"
                            min="0"
                            step="0.1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Flavor</label>
                        <select
                            v-model="flavor"
                            name="flavor"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="">Select flavor</option>
                            <option value="plain">Plain</option>
                            <option value="strawberry">Strawberry</option>
                            <option value="vanilla">Vanilla</option>
                            <option value="mixed-berry">Mixed Berry</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Production Date</label>
                        <input
                            v-model="productionDate"
                            type="date"
                            name="production_date"
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
                        {{ processing ? 'Creating...' : 'Create Batch' }}
                    </button>
                </div>
            </Form>
        </div>
    </div>
</template>
