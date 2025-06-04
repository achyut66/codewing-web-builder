<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;
</script>

<template>
    <!-- <AuthenticatedLayout> -->
        <Head title="Dashboard" />

        <div class="min-h-screen flex bg-gray-100">
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-300 shadow-md hidden md:block">
                <div class="p-6">
                    <img src="../../../public/build/images/logo.png" alt="Logo" class="h-30 mb-6" />
                    <nav class="space-y-4 ml-12">
                        <Link href="/dashboard" class="block text-gray-700 font-medium hover:text-blue-600">My Sites</Link>
                        <Link href="/templates" class="block text-gray-700 font-medium hover:text-blue-600">Templates</Link>
                        <Link href="/settings" class="block text-gray-700 font-medium hover:text-blue-600">Settings</Link>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Topbar -->
                <header class="bg-white shadow-sm p-4 flex items-center justify-between">
                    <h1 class="text-xl font-semibold text-gray-800">Codewing Website Builder</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600 text-sm">Welcome, {{ user.name }}</span>
                        <Link
                            href="/logout"
                            method="post"
                            as="button"
                            class="text-sm text-red-600 hover:underline"
                        >
                            Logout
                        </Link>
                    </div>
                </header>

                <!-- Content Area -->
                <main class="p-6 space-y-6">
                    <!-- Section: Overview -->
                    <section>
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Your Sites</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white p-4 shadow rounded-lg group relative transition duration-200 hover:shadow-lg">
                                <h3 class="text-md font-semibold text-gray-800">My First Site</h3>
                                <p class="text-sm text-gray-500 mt-1">Last updated: June 4, 2025</p>

                                <!-- Buttons on hover -->
                                <div class="absolute bottom-4 right-4 space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <Link
                                        href="/sites/1"
                                        class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                    >
                                        View
                                    </Link>
                                    <Link
                                        href="/sites/1/edit"
                                        class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
                                    >
                                        Edit
                                    </Link>
                                </div>
                            </div>

                                                        <div class="bg-white p-4 shadow rounded-lg group relative transition duration-200 hover:shadow-lg">
                                <h3 class="text-md font-semibold text-gray-800">My First Site</h3>
                                <p class="text-sm text-gray-500 mt-1">Last updated: June 4, 2025</p>

                                <!-- Buttons on hover -->
                                <div class="absolute bottom-4 right-4 space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <Link
                                        href="/sites/1"
                                        class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                    >
                                        View
                                    </Link>
                                    <Link
                                        href="/sites/1/edit"
                                        class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
                                    >
                                        Edit
                                    </Link>
                                </div>
                            </div>

                                                        <div class="bg-white p-4 shadow rounded-lg group relative transition duration-200 hover:shadow-lg">
                                <h3 class="text-md font-semibold text-gray-800">My First Site</h3>
                                <p class="text-sm text-gray-500 mt-1">Last updated: June 4, 2025</p>

                                <!-- Buttons on hover -->
                                <div class="absolute bottom-4 right-4 space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <Link
                                        href="/sites/1"
                                        class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                    >
                                        View
                                    </Link>
                                    <Link
                                        href="/sites/1/edit"
                                        class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
                                    >
                                        Edit
                                    </Link>
                                </div>
                            </div>

                           <div class="bg-white p-4 shadow rounded-lg group relative transition duration-200 hover:shadow-lg">
    <h3 class="text-md font-semibold text-gray-800">My First Site</h3>
    <p class="text-sm text-gray-500 mt-1">Last updated: June 4, 2025</p>

    <!-- Buttons on hover -->
    <div class="absolute bottom-4 right-4 space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
        <Link
            href="/sites/1"
            class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
        >
            View
        </Link>
        <Link
            href="/sites/1/edit"
            class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
        >
            Edit
        </Link>
    </div>
</div>

                            <!-- Add more cards or dynamic content here -->
                        </div>
                    </section>
                </main>
            </div>
        </div>
    <!-- </AuthenticatedLayout> -->
</template>
