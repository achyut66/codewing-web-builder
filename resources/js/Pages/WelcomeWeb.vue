<script setup>
import { Link,Head } from '@inertiajs/vue3'
// useHead({
//   title: 'WelcomeWeb'
// })
</script>

<template>
    <Head title="Welcome" />
  <div class="min-h-screen flex flex-col bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white shadow sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
          <div class="flex items-center space-x-3">
            <img src="../../../public/build/images/logo.png" alt="Logo" class="h-10 w-10" />
            <span class="text-xl font-bold text-blue-600">Codewing Website Builder</span>
          </div>
          <div class="hidden md:flex items-center space-x-6">
            <Link href="/" class="hover:text-blue-600 font-medium">Home</Link>
            <Link href="/features" class="hover:text-blue-600 font-medium">Features</Link>
            <Link href="/pricing" class="hover:text-blue-600 font-medium">Pricing</Link>
            <Link href="/contact" class="hover:text-blue-600 font-medium">Contact</Link>
            <Link href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Login</Link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <header class="flex-grow flex items-center justify-center text-center px-4">
      <div class="max-w-2xl">
        <h1 class="text-5xl font-extrabold mb-4 leading-tight">Build your dream website in minutes</h1>
        <p class="text-lg text-gray-600 mb-6">Codewing Website Builder lets you design, publish, and manage your site — no coding needed.</p>
        <div class="flex justify-center space-x-4">
          <Link href="/register" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
            Get Started Free
          </Link>
          <Link href="/demo" class="text-blue-600 hover:underline font-medium py-3 px-6">
            View Demo
          </Link>
        </div>
      </div>
    </header>

    <!-- Footer -->
    <footer class="bg-white text-center py-4 text-sm text-gray-500 border-t">
      &copy; {{ new Date().getFullYear() }} Codewing Website Builder. All rights reserved.
    </footer>
  </div>
</template>
