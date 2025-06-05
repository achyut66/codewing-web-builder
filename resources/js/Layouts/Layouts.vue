<script setup>
import { usePage, Link } from '@inertiajs/vue3';

const user = usePage().props.auth.user;
</script>

<template>
 <div class="min-h-screen flex bg-gray-100">
  <!-- Sidebar -->
  <aside class="w-64 bg-gray-300 shadow-md hidden md:block fixed inset-y-0 left-0 z-20">
    <div class="p-6">
      <img src="/build/images/logo.png" alt="Logo" class="h-30 mb-6" />
      <nav class="space-y-4 ml-6">
        <Link href="/dashboard" class="block text-gray-700 font-medium hover:text-blue-600">My Sites</Link>
        <Link href="/view-templates" class="block text-gray-700 font-medium hover:text-blue-600">Templates</Link>
        <Link href="/settings" class="block text-gray-700 font-medium hover:text-blue-600">Settings</Link>
      </nav>
    </div>
  </aside>

  <!-- Main Content (pushed right by sidebar) -->
  <div class="flex-1 flex flex-col ml-64">
    <!-- Header -->
    <header class="bg-white shadow-sm p-4 flex items-center justify-between top-0">
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

    <!-- Page Content -->
    <main class="p-6 flex-1 overflow-auto">
      <slot />
    </main>
  </div>
</div>

</template>
