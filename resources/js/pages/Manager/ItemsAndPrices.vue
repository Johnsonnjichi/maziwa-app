<script setup lang="ts">
defineProps<{
    products: Array<{
        id: number
        name: string
        sku: string
        price: number
        unit: string
        category: string
        description: string | null
        is_active: boolean
    }>
}>()
</script>

<template>
    <div class="min-h-screen bg-[#faf9f5] p-4 md:p-6">
        <div class="max-w-7xl mx-auto">
            <div class="mb-6 md:mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Items and Prices</h1>
                <p class="text-gray-600 mt-2">Manage product pricing and inventory</p>
                <p class="mt-2 text-sm text-gray-500">SKU means Stock Keeping Unit — the unique product code used to identify each item in stock and sales records.</p>
            </div>

            <div v-if="products.length === 0" class="rounded-xl border border-dashed border-gray-300 bg-white p-8 text-center shadow-sm">
                <p class="text-lg font-semibold text-gray-900">No products have been configured yet.</p>
                <p class="mt-2 text-sm text-gray-600">Seed the database or add a product to show pricing here.</p>
            </div>

            <div v-else class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product
                            </th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                SKU
                            </th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Category
                            </th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Unit
                            </th>
                            <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="product in products" :key="product.id">
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ product.name }}</div>
                                <div class="text-xs md:text-sm text-gray-500 hidden md:block">{{ product.description }}</div>
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">
                                {{ product.sku }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-xs md:text-sm text-gray-500 hidden md:table-cell">
                                {{ product.category }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-xs md:text-sm font-medium text-gray-900">
                                KES {{ Number(product.price).toFixed(2) }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap text-xs md:text-sm text-gray-500 hidden md:table-cell">
                                {{ product.unit }}
                            </td>
                            <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full"
                                    :class="product.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                >
                                    {{ product.is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
