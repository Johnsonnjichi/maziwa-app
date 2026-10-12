<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { computed, reactive } from 'vue';

const props = defineProps<{
    permissionLabels: Record<string, string>
    roles: Array<{
        name: string
        label: string
        permissions: string[]
        is_admin: boolean
    }>
}>()

const form = reactive({
    roles: Object.fromEntries(
        props.roles.map((role) => [role.name, [...role.permissions]]),
    ) as Record<string, string[]>,
})

const permissionOrder = computed(() => Object.keys(props.permissionLabels))

const togglePermission = (roleName: string, permission: string) => {
    const permissions = form.roles[roleName] ?? []
    const exists = permissions.includes(permission)

    form.roles[roleName] = exists
        ? permissions.filter((current) => current !== permission)
        : [...permissions, permission]
}

const submit = () => {
    router.post('/admin/permissions', {
        roles: form.roles,
    }, {
        preserveScroll: true,
        onSuccess: () => {
            window.location.reload()
        },
    })
}
</script>

<template>
    <Head title="Permission management" />

    <div class="min-h-screen bg-[#f9f6ef] p-4 md:p-6">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-[28px] border border-[#d9d2c5] bg-[#fffdf9] p-5 shadow-[0_18px_45px_rgba(27,52,47,0.08)] md:p-7">
                <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#43756d]">Admin</p>
                        <h1 class="mt-2 text-2xl font-bold text-[#1d3b36] md:text-3xl">Permission management</h1>
                    </div>
                    <div class="rounded-full border border-[#dfe8df] bg-[#edf5ee] px-4 py-2 text-sm font-medium text-[#224f4b]">
                        Role matrix
                    </div>
                </div>
            </div>

            <div class="rounded-[28px] border border-[#d9d2c5] bg-[#fffdf9] p-4 shadow-[0_18px_45px_rgba(27,52,47,0.08)] md:p-6">
                <div class="mb-5 flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-[#1d3b36]">Assign permissions by role</h2>
                        <p class="mt-1 text-sm text-[#586a66]">Update the access matrix for operational roles without changing the core system rules.</p>
                    </div>

                    <button
                        type="button"
                        class="rounded-lg bg-[#1d5d58] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#174b48]"
                        @click="submit"
                    >
                        Save permissions
                    </button>
                </div>

                <div class="overflow-hidden rounded-2xl border border-[#e5dfd3]">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-separate border-spacing-0">
                            <thead class="bg-[#f3eee7] text-left text-[#355d58]">
                                <tr>
                                    <th class="px-4 py-3 text-sm font-semibold">Role</th>
                                    <th v-for="permission in permissionOrder" :key="permission" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.14em] text-[#4b706b]">
                                        {{ permissionLabels[permission] }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="role in props.roles" :key="role.name" class="border-t border-[#efe8df] bg-white">
                                    <td class="border-r border-[#efe8df] px-4 py-4 align-top">
                                        <div class="flex items-center justify-between gap-3">
                                            <div>
                                                <div class="text-sm font-semibold text-[#1f2c2b]">{{ role.label }}</div>
                                                <div class="mt-1 text-xs text-[#697b78]">
                                                    <span v-if="role.is_admin">Full system access</span>
                                                    <span v-else>Operational access</span>
                                                </div>
                                            </div>
                                            <span
                                                v-if="role.is_admin"
                                                class="inline-flex rounded-full bg-[#edf5ee] px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#1e5a57]"
                                            >
                                                Locked
                                            </span>
                                        </div>
                                    </td>

                                    <td
                                        v-for="permission in permissionOrder"
                                        :key="`${role.name}-${permission}`"
                                        class="border-r border-[#efe8df] px-3 py-4 text-center align-middle"
                                    >
                                        <label
                                            class="flex cursor-pointer items-center justify-center"
                                            :class="role.is_admin ? 'cursor-not-allowed opacity-100' : ''"
                                        >
                                            <input
                                                type="checkbox"
                                                :checked="(form.roles[role.name] ?? []).includes(permission)"
                                                :disabled="role.is_admin"
                                                class="h-4 w-4 rounded border-[#b8cfc8] bg-white text-[#1d5d58] accent-[#1d5d58]"
                                                @change="togglePermission(role.name, permission)"
                                            />
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
