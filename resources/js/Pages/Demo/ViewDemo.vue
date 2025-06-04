<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen bg-white text-gray-800 flex flex-col">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-20 px-4 text-center">
      <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Welcome to Your Future Site</h1>
        <p class="text-lg sm:text-xl text-blue-100 mb-6">This is what your website could look like with Codewing Website Builder.</p>
        <Link
          href="/login"
          class="bg-white text-blue-700 font-semibold py-2 px-5 rounded-lg shadow hover:bg-gray-100 transition"
        >
          Start Building
        </Link>
      </div>
    </header>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50 px-4">
      <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-3xl font-bold mb-12">What You Get</h2>
        <div class="grid md:grid-cols-3 gap-8 text-left">
          <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-semibold mb-2">Drag & Drop Builder</h3>
            <p class="text-gray-600">Easily arrange elements and sections to create stunning layouts — no code needed.</p>
          </div>
          <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-semibold mb-2">Mobile-Responsive</h3>
            <p class="text-gray-600">Every site you build looks amazing on phones, tablets, and desktops automatically.</p>
          </div>
          <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-xl font-semibold mb-2">Custom Domains</h3>
            <p class="text-gray-600">Launch your site with a custom domain or use one of ours instantly.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-white py-12 px-4 text-center">
      <h2 class="text-2xl font-bold mb-4">Ready to launch your site?</h2>
      <Link
        href="/register"
        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition"
      >
        Get Started Free
      </Link>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-6 text-sm text-gray-500 mt-auto">
      &copy; {{ new Date().getFullYear() }} Codewing Website Builder. Demo only. All rights reserved.
    </footer>
  </div>
</template>
