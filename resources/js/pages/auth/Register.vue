<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

defineProps<{
    passwordRules: string;
}>();

defineOptions({
    layout: {
        title: 'Create an account',
        description: 'Enter your details below to create your account',
    },
});
</script>

<template>
    <Head title="Register" />

    <div class="mb-6 text-center">
        <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-[#2d5d57]">PEDA</p>
        <h3 class="mt-2 text-2xl font-semibold text-[#1d3b36]">Create your account</h3>
        <p class="mt-2 text-sm text-[#5f716d]">Set up your access and start tracking daily operations.</p>
    </div>

    <Form
        v-bind="store.form()"
        :reset-on-success="['password', 'password_confirmation']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-5 rounded-[24px] border border-[#dfe8df] bg-[#f9f7f3] p-4 shadow-[0_16px_36px_rgba(17,62,55,0.06)] sm:p-5"
    >
        <div class="grid gap-5">
            <div class="grid gap-2">
                <Label for="name" class="text-sm font-medium text-[#27423f]">Full name</Label>
                <Input
                    id="name"
                    type="text"
                    required
                    v-focus
                    :tabindex="1"
                    autocomplete="name"
                    name="name"
                    placeholder="Full name"
                    class="h-11 rounded-xl border-[#cfe0d7] bg-white text-[#183d3b] placeholder:text-[#7a8d89] focus-visible:ring-[#1d5d58]"
                />
                <InputError :message="errors.name" />
            </div>

            <div class="grid gap-2">
                <Label for="email" class="text-sm font-medium text-[#27423f]">Email address</Label>
                <Input
                    id="email"
                    type="email"
                    required
                    :tabindex="2"
                    autocomplete="email"
                    name="email"
                    placeholder="email@example.com"
                    class="h-11 rounded-xl border-[#cfe0d7] bg-white text-[#183d3b] placeholder:text-[#7a8d89] focus-visible:ring-[#1d5d58]"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-2">
                <Label for="password" class="text-sm font-medium text-[#27423f]">Password</Label>
                <PasswordInput
                    id="password"
                    required
                    :tabindex="3"
                    autocomplete="new-password"
                    name="password"
                    placeholder="Password"
                    :passwordrules="passwordRules"
                    class="h-11 rounded-xl border-[#cfe0d7] bg-white text-[#183d3b] placeholder:text-[#7a8d89] focus-visible:ring-[#1d5d58]"
                />
                <InputError :message="errors.password" />
            </div>

            <div class="grid gap-2">
                <Label for="password_confirmation" class="text-sm font-medium text-[#27423f]">Confirm password</Label>
                <PasswordInput
                    id="password_confirmation"
                    required
                    :tabindex="4"
                    autocomplete="new-password"
                    name="password_confirmation"
                    placeholder="Confirm password"
                    :passwordrules="passwordRules"
                    class="h-11 rounded-xl border-[#cfe0d7] bg-white text-[#183d3b] placeholder:text-[#7a8d89] focus-visible:ring-[#1d5d58]"
                />
                <InputError :message="errors.password_confirmation" />
            </div>

            <Button
                type="submit"
                class="mt-2 w-full rounded-xl bg-[#1d5d58] px-4 py-2.5 text-sm font-semibold text-white shadow-[0_16px_30px_rgba(29,93,88,0.28)] hover:bg-[#163f3d]"
                tabindex="5"
                :disabled="processing"
                data-test="register-user-button"
            >
                <Spinner v-if="processing" />
                Create account
            </Button>
        </div>

        <div class="text-center text-sm text-[#5f716d]">
            Already have an account?
            <TextLink
                :href="login()"
                class="font-medium text-[#1d5d58] hover:text-[#163f3d]"
                :tabindex="6"
                >Log in</TextLink
            >
        </div>
    </Form>
</template>
