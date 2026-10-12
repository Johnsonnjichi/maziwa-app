<script setup lang="ts">
import { Form } from '@inertiajs/vue3'

const props = defineProps<{
    stockTransfer: {
        id: number
        quantity: number
        transfer_date: string
        status: string
        notes: string | null
        product: {
            id: number
            name: string
            unit: string
        }
        fromBranch: {
            id: number
            name: string
        } | null
        user: {
            id: number
            name: string
        }
    }
}>()
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-3 md:p-4">
        <div class="max-w-md mx-auto">
            <div class="mb-4 md:mb-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Confirm Arrival</h1>
                <p class="text-gray-600 mt-1 text-sm md:text-base">Confirm stock transfer receipt</p>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200 mb-4">
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Product:</span>
                        <span class="font-medium text-gray-900">{{ stockTransfer.product.name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Quantity:</span>
                        <span class="font-medium text-gray-900">{{ stockTransfer.quantity }} {{ stockTransfer.product.unit }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">From Branch:</span>
                        <span class="font-medium text-gray-900">{{ stockTransfer.fromBranch?.name || 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Transfer Date:</span>
                        <span class="font-medium text-gray-900">{{ stockTransfer.transfer_date }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Sent By:</span>
                        <span class="font-medium text-gray-900">{{ stockTransfer.user.name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span
                            class="px-2 py-1 text-xs font-medium rounded-full"
                            :class="{
                                'bg-yellow-100 text-yellow-800': stockTransfer.status === 'pending',
                                'bg-blue-100 text-blue-800': stockTransfer.status === 'in_transit',
                                'bg-green-100 text-green-800': stockTransfer.status === 'delivered',
                                'bg-gray-100 text-gray-800': stockTransfer.status === 'confirmed'
                            }"
                        >
                            {{ stockTransfer.status.replace('_', ' ').toUpperCase() }}
                        </span>
                    </div>
                    <div v-if="stockTransfer.notes" class="pt-3 border-t border-gray-200">
                        <span class="text-gray-600">Notes:</span>
                        <p class="text-gray-900 mt-1">{{ stockTransfer.notes }}</p>
                    </div>
                </div>
            </div>

            <Form
                :action="`/branch/stock-transfers/${stockTransfer.id}/confirm`"
                method="post"
                #default="{ processing }"
            >
                <button
                    type="submit"
                    :disabled="processing || stockTransfer.status === 'confirmed'"
                    class="w-full py-3 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    {{ processing ? 'Confirming...' : 'Confirm Receipt' }}
                </button>
            </Form>
        </div>
    </div>
</template>
