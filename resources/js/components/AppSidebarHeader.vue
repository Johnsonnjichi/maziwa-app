<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItem } from '@/types';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItem[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center justify-between gap-2 border-b border-[#dfe9df] bg-[#edf3ee] px-4 backdrop-blur-sm md:px-6"
    >
        <div class="flex items-center gap-2">
            <SidebarTrigger
                class="md:hidden h-9 w-9 rounded-xl border border-[#dfe8df] bg-white text-[#173d3b] hover:bg-[#ddeae1]"
            />
        </div>

        <div class="flex min-w-0 flex-1 items-center justify-end gap-2">
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>
    </header>
</template>
