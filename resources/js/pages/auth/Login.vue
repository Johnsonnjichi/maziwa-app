<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import PasskeyVerify from '@/components/PasskeyVerify.vue';

defineOptions({
    layout: {
        title: 'Log in to your account',
        description: 'Use your email and password to access your role-specific dashboard.',
    },
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <Head title="Log in" />

    <div class="mb-5 rounded-2xl border border-[#d3e6dd] bg-[#edf5ee] px-4 py-3 text-sm text-[#1d5d58]" v-if="status">
        {{ status }}
    </div>

    <div class="mb-6 text-center">
        <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-[#2d5d57]">PEDA</p>
        <h3 class="mt-2 text-2xl font-semibold text-[#1d3b36]">Welcome back</h3>
        <p class="mt-2 text-sm text-[#5f716d]">Access your dashboard with your assigned role permissions.</p>
    </div>

    <PasskeyVerify />

    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-5 rounded-[24px] border border-[#dfe8df] bg-[#f9f7f3] p-4 shadow-[0_16px_36px_rgba(17,62,55,0.06)] sm:p-5"
    >
        <div class="grid gap-5">
            <div class="grid gap-2">
                <Label for="email" class="text-sm font-medium text-[#27423f]">Email address</Label>
                <Input
                    id="email"
                    type="email"
                    name="email"
                    required
                    v-focus
                    :tabindex="1"
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="h-11 rounded-xl border-[#cfe0d7] bg-white text-[#183d3b] placeholder:text-[#7a8d89] focus-visible:ring-[#1d5d58]"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <Label for="password" class="text-sm font-medium text-[#27423f]">Password</Label>
                    <TextLink
                        v-if="canResetPassword"
                        :href="request()"
                        class="text-sm text-[#1d5d58] hover:text-[#163f3d]"
                        :tabindex="5"
                    >
                        Forgot password?
                    </TextLink>
                </div>
                <PasswordInput
                    id="password"
                    name="password"
                    required
                    :tabindex="2"
                    autocomplete="current-password"
                    placeholder="Password"
                    class="h-11 rounded-xl border-[#cfe0d7] bg-white text-[#183d3b] placeholder:text-[#7a8d89] focus-visible:ring-[#1d5d58]"
                />
                <InputError :message="errors.password" />
            </div>

            <div class="flex items-center justify-between">
                <Label for="remember" class="flex items-center space-x-3 text-[#355d58]">
                    <Checkbox id="remember" name="remember" :tabindex="3" class="border-[#bfd2c9] data-[state=checked]:bg-[#1d5d58]" />
                    <span>Remember me</span>
                </Label>
            </div>

            <Button
                type="submit"
                class="mt-2 w-full rounded-xl bg-[#1d5d58] px-4 py-2.5 text-sm font-semibold text-white shadow-[0_16px_30px_rgba(29,93,88,0.28)] hover:bg-[#163f3d]"
                :tabindex="4"
                :disabled="processing"
                data-test="login-button"
            >
                <Spinner v-if="processing" />
                Log in
            </Button>
        </div>

        <div class="text-center text-sm text-[#5f716d]">
            Need an account?
            <TextLink :href="register()" :tabindex="5" class="font-medium text-[#1d5d58] hover:text-[#163f3d]">Create one</TextLink>
        </div>
    </Form>
</template>
