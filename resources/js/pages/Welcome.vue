<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
</script>

<template>
    <Head title="PEDA Operations" />

    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-slate-100 text-slate-900 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 dark:text-white">
        <header class="mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-5 md:px-8">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 font-bold text-white shadow-sm">
                    P
                </div>
                <div>
                    <div class="text-[10px] font-medium uppercase tracking-[0.2em] text-emerald-600 dark:text-emerald-400">
                        PEDA
                    </div>
                    <div class="text-sm font-semibold">Operations</div>
                </div>
            </div>

            <nav class="flex items-center gap-3">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-emerald-200 hover:text-emerald-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-emerald-200 hover:text-emerald-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="register()"
                        class="rounded-full bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-500"
                    >
                        Create account
                    </Link>
                </template>
            </nav>
        </header>

        <main class="mx-auto grid w-full max-w-6xl gap-10 px-6 pb-16 pt-6 md:px-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-center lg:pt-10">
            <section class="space-y-8">
                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-medium uppercase tracking-[0.2em] text-emerald-700 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-300">
                    Dairy operations dashboard
                </div>

                <div class="space-y-5">
                    <h1 class="text-4xl font-bold tracking-tight md:text-5xl">
                        Manage sales, milk flow, and stock from one control point.
                    </h1>
                    <p class="max-w-xl text-lg leading-8 text-slate-600 dark:text-slate-300">
                        PEDA helps teams monitor daily dairy operations, record sales, track inventory, and close each day with confidence.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <Link
                        :href="login()"
                        class="rounded-full bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-600/25 transition hover:bg-emerald-500"
                    >
                        Sign in to continue
                    </Link>
                    <Link
                        :href="register()"
                        class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200"
                    >
                        Create an account
                    </Link>
                </div>

                <div class="grid gap-4 md:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900/60">
                        <div class="text-sm text-slate-500 dark:text-slate-400">Sales</div>
                        <div class="mt-2 text-2xl font-bold">Real-time</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900/60">
                        <div class="text-sm text-slate-500 dark:text-slate-400">Stock</div>
                        <div class="mt-2 text-2xl font-bold">Tracked</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900/60">
                        <div class="text-sm text-slate-500 dark:text-slate-400">Close-out</div>
                        <div class="mt-2 text-2xl font-bold">Daily</div>
                    </div>
                </div>
            </section>

            <aside class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_25px_80px_rgba(15,23,42,0.08)] dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Overview</p>
                        <h2 class="mt-2 text-xl font-semibold">Operations summary</h2>
                    </div>
                    <div class="rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
                        Live
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-800/80">
                        <div class="text-sm text-slate-500 dark:text-slate-400">What teams do</div>
                        <ul class="mt-3 space-y-2 text-sm text-slate-700 dark:text-slate-200">
                            <li>• Record daily sales and product movement</li>
                            <li>• Track item prices and branch stock</li>
                            <li>• Monitor milk intake and daily close-outs</li>
                        </ul>
                    </div>

                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-500/20 dark:bg-emerald-500/5">
                        <div class="text-sm font-medium text-emerald-700 dark:text-emerald-300">Login access</div>
                        <p class="mt-2 text-sm text-emerald-800 dark:text-emerald-200">
                            Use your work email and password to access the dashboard with the permissions assigned to your role.
                        </p>
                    </div>
                </div>
            </aside>
        </main>
    </div>
</template>
