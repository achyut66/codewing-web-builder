<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="flex flex-col lg:flex-row bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Left: Illustration or Logo -->
            <div class="hidden lg:flex lg:w-2/2 bg-blue-600 text-white items-center justify-center p-10">
                <div class="text-center space-y-4">
                    <img src="../../../../public/build/images/logo.png" alt="Logo" class="h-16 mx-auto" />
                    <h2 class="text-3xl font-bold">Welcome Back</h2>
                    <p class="text-lg">Log in to continue building with Codewing.</p>
                </div>
            </div>

            <!-- Right: Login Form -->
            <div class="w-full lg:w-2/2 p-8 sm:p-12">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">Sign in to your account</h1>
                <p class="text-sm text-gray-500 mb-6">Enter your credentials below to access your dashboard.</p>

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="flex justify-between items-center">
                        <label class="flex items-center text-sm text-gray-600">
                            <Checkbox name="remember" v-model:checked="form.remember" class="mr-2" />
                            Remember me
                        </label>
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-sm text-blue-600 hover:underline"
                        >
                            Forgot password?
                        </Link>
                    </div>

                    <div>
                        <PrimaryButton
                            class="w-full justify-center"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
                        </PrimaryButton>
                    </div>

                    <div class="text-sm text-center text-gray-600 mt-6">
                        Don’t have an account?
                        <Link href="/register" class="text-blue-600 hover:underline">Sign up</Link>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
