<script setup lang="ts">
const props = defineProps<{
    summary: {
        items_sold: number
        top_product: string
        total_revenue: number
    }
    items: Array<{
        product_id: number
        name: string
        sku: string
        quantity: number
        revenue: number
    }>
}>()

const formatMoney = (value: number) => new Intl.NumberFormat('en-KE', { style: 'currency', currency: 'KES', maximumFractionDigits: 2 }).format(value)
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-4 md:p-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Sale Items Dashboard</h1>
                <p class="mt-2 text-gray-600">Best-performing products by volume and revenue</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Items sold</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ props.summary.items_sold }}</p>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Top product</p>
                    <p class="mt-2 text-xl font-bold text-gray-900">{{ props.summary.top_product }}</p>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Revenue</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ formatMoney(props.summary.total_revenue) }}</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 px-4 py-3">
                    <h2 class="text-lg font-semibold text-gray-900">Top products</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Product</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">SKU</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Quantity</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Revenue</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="item in props.items" :key="item.product_id">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ item.name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ item.sku }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ item.quantity }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ formatMoney(item.revenue) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
