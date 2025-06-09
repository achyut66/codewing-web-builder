<script setup>
import { usePage, Link } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const open = ref(false)
const dropdownRef = ref(null)

function toggleDropdown() {
  open.value = !open.value
}

function handleClickOutside(event) {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    open.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
})

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
        <div class="relative" ref="dropdownRef">
  <button @click="toggleDropdown"
        class="flex items-center justify-between w-full text-gray-700 font-medium hover:text-blue-600 focus:outline-none">
  <span>Settings</span>
  <svg :class="['w-4 h-4 transition-transform duration-200', open ? 'rotate-180' : 'rotate-0']"
       fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
  </svg>
</button>


  <div class="relative" ref="dropdownRef">
  <!-- Button above goes here -->

  <div v-if="open"
       class="absolute mt-2 w-46 bg-white border border-gray-200 rounded-md shadow-lg z-50">
    <ul class="py-1">
      <li>
        <Link href="/settings/site-title"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          Site Title
        </Link>
      </li>
      <li>
        <Link href="/settings/tagline"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          Tagline & Description
        </Link>
      </li>
      <li>
        <Link href="/settings/language"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          Site Language
        </Link>
      </li>
      <li>
        <Link href="/settings/timezone"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          Timezone
        </Link>
      </li>
    </ul>
  </div>
</div>

        </div>
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
