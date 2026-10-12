<script setup lang="ts">
const props = defineProps<{
    summary: {
        total_sales: number
        total_revenue: number
        average_order: number
        units_sold: number
    }
    sales: Array<{
        id: number
        user: string
        payment_method: string
        total_amount: number
        cash_received: number
        change_given: number
        created_at: string
        items: Array<{
            product: string
            quantity: number
            subtotal: number
        }>
    }>
}>()

const formatMoney = (value: number) => new Intl.NumberFormat('en-KE', { style: 'currency', currency: 'KES', maximumFractionDigits: 2 }).format(value)
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-4 md:p-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Sales Dashboard</h1>
                    <p class="mt-2 text-gray-600">Revenue overview and recent transactions</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Sales</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ props.summary.total_sales }}</p>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Revenue</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ formatMoney(props.summary.total_revenue) }}</p>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Average Order</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ formatMoney(props.summary.average_order) }}</p>
                </div>
                <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Units Sold</p>
                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ props.summary.units_sold }}</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 px-4 py-3">
                    <h2 class="text-lg font-semibold text-gray-900">Recent sales</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Sale</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Cashier</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Method</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Items</th>
                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="sale in props.sales" :key="sale.id">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">#{{ sale.id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ sale.user }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ sale.payment_method }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ formatMoney(sale.total_amount) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    <div v-for="item in sale.items" :key="`${sale.id}-${item.product}`" class="space-y-1">
                                        <span>{{ item.product }} × {{ item.quantity }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ sale.created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
