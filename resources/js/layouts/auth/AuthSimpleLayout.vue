<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="min-h-svh bg-[radial-gradient(circle_at_top,_#f8f4eb_0%,_#eef2ec_32%,_#edf3f1_100%)] p-4 md:p-8">
        <div class="mx-auto flex min-h-[calc(100vh-2rem)] max-w-6xl items-center justify-center">
            <div class="grid w-full overflow-hidden rounded-[28px] border border-[#d9d2c5] bg-[#fffdf9]/90 shadow-[0_30px_80px_rgba(29,59,54,0.10)] backdrop-blur-xl">
                <div class="grid gap-8 bg-gradient-to-br from-[#1d4d4f] via-[#2b5f5c] to-[#4d7d6e] p-8 text-white md:p-10 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
                    <div class="space-y-6">
                        <Link :href="home()" class="inline-flex items-center gap-3 font-medium text-white/90">
                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/12 ring-1 ring-white/20">
                                <AppLogoIcon class="size-6 fill-current text-white" />
                            </div>
                            <div>
                                <div class="text-xs uppercase tracking-[0.28em] text-[#dfece8]">PEDA</div>
                                <div class="text-lg font-semibold">Operations</div>
                            </div>
                        </Link>

                        <div class="space-y-3">
                            <p class="text-xs uppercase tracking-[0.28em] text-[#dfece8]">Daily control</p>
                            <h1 class="text-3xl font-semibold leading-tight md:text-4xl">Keep sales, stock, and milk flow in one place.</h1>
                        </div>

                        <div class="grid gap-3 text-sm text-[#ecf5f2]/90 sm:grid-cols-2">
                            <div class="rounded-2xl border border-white/15 bg-white/6 p-4">
                                <div class="font-semibold text-white">Sales</div>
                                <p class="mt-1">Track every sale, payment, and revenue milestone.</p>
                            </div>
                            <div class="rounded-2xl border border-white/15 bg-white/6 p-4">
                                <div class="font-semibold text-white">Inventory</div>
                                <p class="mt-1">Monitor stock levels and item pricing from a single view.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#fffdf9] p-6 md:p-8">
                        <div class="mb-6 text-center">
                            <p class="text-xs font-medium uppercase tracking-[0.2em] text-[#2d5d57]">Access your account</p>
                            <h2 class="mt-3 text-2xl font-semibold text-[#1d3b36]">{{ title }}</h2>
                            <p class="mt-2 text-sm text-[#5f716d]">{{ description }}</p>
                        </div>
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
