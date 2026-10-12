<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import {
    BarChart3,
    Boxes,
    CreditCard,
    Factory,
    LayoutGrid,
    ShieldCheck,
    Truck,
    Warehouse,
} from '@lucide/vue';
import { computed } from 'vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';

const page = usePage();
const user = computed(() => page.props.auth.user);

const accessMap: Record<string, Set<string>> = {
    admin: new Set([
        'dashboard',
        'view_branches',
        'view_branch_details',
        'manage_items_prices',
        'record_sales',
        'add_milk_inventory',
        'add_expenses',
        'record_wastage',
        'end_of_day',
        'make_yoghurt',
        'send_stock',
        'confirm_arrival',
        'manage_permissions',
    ]),
    manager: new Set([
        'dashboard',
        'view_branches',
        'view_branch_details',
        'manage_items_prices',
        'record_sales',
        'add_milk_inventory',
        'add_expenses',
        'record_wastage',
        'end_of_day',
        'make_yoghurt',
        'send_stock',
        'confirm_arrival',
    ]),
    worker: new Set([
        'dashboard',
        'record_sales',
        'add_milk_inventory',
        'add_expenses',
        'record_wastage',
        'end_of_day',
    ]),
};

const canAccess = (permission: string) => {
    const role = user.value?.role ?? 'guest';

    if (!user.value) {
        return false;
    }

    return accessMap[role]?.has(permission) ?? false;
};

const navItems = [
    {
        section: 'Overview',
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
        permission: 'dashboard',
    },
    {
        section: 'Sales',
        title: 'Sales Overview',
        href: '/sales-dashboard',
        icon: BarChart3,
        permission: 'record_sales',
    },
    {
        section: 'Inventory',
        title: 'Items & Prices',
        href: '/manager/items-prices',
        icon: Boxes,
        permission: 'manage_items_prices',
    },
    {
        section: 'Daily Tasks',
        title: 'Milk Received',
        href: '/worker/milk-received',
        icon: Warehouse,
        permission: 'add_milk_inventory',
    },
    {
        section: 'Daily Tasks',
        title: 'Add Expense',
        href: '/worker/add-expense',
        icon: CreditCard,
        permission: 'add_expenses',
    },
    {
        section: 'Daily Tasks',
        title: 'Record Wastage',
        href: '/worker/wastage',
        icon: Truck,
        permission: 'record_wastage',
    },
    {
        section: 'Daily Tasks',
        title: 'End of Day',
        href: '/worker/end-of-day',
        icon: BarChart3,
        permission: 'end_of_day',
    },
    {
        section: 'Daily Tasks',
        title: 'Close the Day',
        href: '/worker/close-the-day',
        icon: Factory,
        permission: 'end_of_day',
    },
    {
        section: 'Operations',
        title: 'Record Sale',
        href: '/worker/record-sale',
        icon: CreditCard,
        permission: 'record_sales',
    },
    {
        section: 'Operations',
        title: 'Branch Stock',
        href: '/manager/branches',
        icon: Warehouse,
        permission: 'view_branches',
    },
    {
        section: 'Production',
        title: 'Yoghurt Production',
        href: '/kitchen/make-yoghurt',
        icon: Factory,
        permission: 'make_yoghurt',
    },
    {
        section: 'Production',
        title: 'Send Stock',
        href: '/kitchen/send-stock',
        icon: Truck,
        permission: 'send_stock',
    },
    {
        section: 'Admin',
        title: 'Permission Matrix',
        href: '/admin/permissions',
        icon: ShieldCheck,
        permission: 'manage_permissions',
    },
];

const visibleNavItems = computed(() =>
    navItems.filter((item) => canAccess(item.permission)),
);
</script>

<template>
    <Sidebar collapsible="icon" variant="inset" class="border-r border-[#dfe8df] bg-[#edf3ee] text-[#183d3b]">
        <SidebarHeader class="border-b border-[#dfe8df] bg-[#e6efe8]">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="'/dashboard'" class="flex items-center gap-3 rounded-xl px-1 py-1.5">
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#1f5d58] text-sm font-bold text-white shadow-sm shadow-[#1f5d58]/20">
                                P
                            </div>
                            <div class="flex-1 text-left leading-none">
                                <span class="block text-[11px] font-semibold uppercase tracking-[0.24em] text-[#173d3b]">PEDA OPERATIONS</span>
                            </div>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent class="bg-[#edf3ee]">
            <nav class="space-y-5 px-2 py-4">
                <template v-for="section in ['Overview', 'Sales', 'Inventory', 'Daily Tasks', 'Operations', 'Production', 'Admin']" :key="section">
                    <div v-if="visibleNavItems.some((item) => item.section === section)" class="space-y-1">
                        <div class="mb-2 px-2 text-[10px] font-semibold uppercase tracking-[0.2em] text-[#58756f]">
                            {{ section }}
                        </div>

                        <Link
                            v-for="item in visibleNavItems.filter((entry) => entry.section === section)"
                            :key="item.title"
                            :href="item.href"
                            class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-[#244d49] transition-colors hover:bg-[#ddeae1] hover:text-[#123b38]"
                        >
                            <component :is="item.icon" class="h-4 w-4" />
                            <span>{{ item.title }}</span>
                        </Link>
                    </div>
                </template>
            </nav>
        </SidebarContent>

        <SidebarFooter class="border-t border-[#dfe8df] bg-[#e6efe8]">
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
