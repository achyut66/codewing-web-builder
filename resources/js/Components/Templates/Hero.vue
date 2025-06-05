<script setup>
import { ref } from 'vue'
import axios from 'axios'

// Navbar menu
const navbarItems = ref([
  { name: 'Home', href: '/' },
  { name: 'About', href: '/about' },
  { name: 'Contact', href: '/contact' },
])

// Hero section
const heroTitle = ref('Hi, I am John Doe')
const heroSubtitle = ref('A passionate web developer')
const heroBackgroundImage = ref('https://images.unsplash.com/photo-1507525428034-b723cf961d3e')

// Main content
const mainHeading = ref('Welcome to My Website')
const mainContent = ref('This is the main content area. You can add anything you want here.')

// Footer
const footerText = ref('© 2025 John Doe. All rights reserved.')

// Save states
const message = ref('')
const error = ref('')
const loading = ref(false)

const showNavbarEditor = ref(false)
const showHeroEditor = ref(false)
const showMainEditor = ref(false)
const showFooterEditor = ref(false)

function addMenuItem() {
  navbarItems.value.push({ name: '', href: '' })
}

function removeMenuItem(index) {
  navbarItems.value.splice(index, 1)
}

async function saveAll() {
  loading.value = true
  message.value = ''
  error.value = ''

  try {
    const payload = {
      navbar: navbarItems.value,
      hero: {
        title: heroTitle.value,
        subtitle: heroSubtitle.value,
        backgroundImage: heroBackgroundImage.value,
      },
      mainContent: {
        heading: mainHeading.value,
        content: mainContent.value,
      },
      footer: {
        text: footerText.value,
      },
    }

    // Replace with your API
    await axios.post('/api/websites/1/update-page', payload)
    message.value = 'Content saved successfully!'
  } catch (e) {
    error.value = 'Failed to save content.'
  } finally {
    loading.value = false
  }
}
</script>
<template>
  <div class="min-h-screen p-6 bg-gray-100 flex flex-col gap-6">
    <div class="grid grid-cols-12 gap-8 max-w-7xl mx-auto">
      <div class="col-span-12 md:col-span-4 bg-white p-6 rounded shadow overflow-auto max-h-screen">
        <!-- navbar section -->
        <div class="mb-6 border rounded shadow">
  <!-- Dropdown Header -->
  <div
    @click="showNavbarEditor = !showNavbarEditor"
    class="cursor-pointer bg-indigo-100 px-24 py-2 font-semibold text-indigo-800 flex justify-between items-center"
  >
     Navbar Menu
    <span>
      <svg
        v-if="!showNavbarEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>

  <!-- Dropdown Content -->
  <div v-if="showNavbarEditor" class="px-4 py-4">
    <div
      v-for="(item, index) in navbarItems"
      :key="index"
      class="flex gap-1 mb-3 items-center"
    >
      <input
        v-model="item.name"
        type="text"
        placeholder="Menu Text"
        class="w-16 border rounded px-2 py-1 flex-1"
      />
      <input
        v-model="item.href"
        type="text"
        placeholder="URL"
        class="w-16 border rounded px-3 py-1 flex-1"
      />
      <button
        @click="removeMenuItem(index)"
        class="bg-red-600 text-white px-2 rounded hover:bg-red-700"
      >
        &times;
      </button>
    </div>
    <button
      @click="addMenuItem"
      class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700"
    >
      + Menu
    </button>
  </div>
        </div>


        <!-- Hero Section -->
        <div class="mb-6 border rounded shadow">
  <!-- Dropdown Header -->
  <div
    @click="showHeroEditor = !showHeroEditor"
    class="cursor-pointer bg-indigo-100 px-4 py-2 font-semibold text-indigo-800 flex justify-between items-center"
  >
    Edit Hero Section
    <span>
      <svg
        v-if="!showHeroEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>

  <!-- Dropdown Content -->
  <div v-if="showHeroEditor" class="px-4 py-4">
    <label class="block mb-1 font-medium">Title</label>
    <input
      v-model="heroTitle"
      type="text"
      class="w-full mb-2 border rounded px-3 py-1"
      placeholder="Hero title"
    />

    <label class="block mb-1 font-medium">Subtitle</label>
    <input
      v-model="heroSubtitle"
      type="text"
      class="w-full mb-2 border rounded px-3 py-1"
      placeholder="Hero subtitle"
    />

    <label class="block mb-1 font-medium">Background Image</label>
    <input
      v-model="heroBackgroundImage"
      type="text"
      class="w-full border rounded px-3 py-1"
      placeholder="Image URL"
    />
  </div>
        </div>


        <!-- Main Content Section -->
        <div class="mb-6 border rounded shadow">
  <!-- Dropdown Header -->
  <div
    @click="showMainEditor = !showMainEditor"
    class="cursor-pointer bg-indigo-100 px-4 py-2 font-semibold text-indigo-800 flex justify-between items-center"
  >
    Edit Main Content
    <span>
      <svg
        v-if="!showMainEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>

  <!-- Dropdown Content -->
  <div v-if="showMainEditor" class="px-4 py-4">
    <label class="block mb-1 font-medium">Heading</label>
    <input
      v-model="mainHeading"
      type="text"
      class="w-full mb-2 border rounded px-3 py-1"
      placeholder="Main heading"
    />

    <label class="block mb-1 font-medium">Content</label>
    <textarea
      v-model="mainContent"
      rows="4"
      class="w-full border rounded px-3 py-2"
      placeholder="Write main content..."
    />
  </div>
        </div>


        <!-- Footer -->
        <div class="mb-6 border rounded shadow">
  <!-- Toggle Header -->
  <div
    @click="showFooterEditor = !showFooterEditor"
    class="cursor-pointer bg-indigo-100 px-4 py-2 font-semibold text-indigo-800 flex justify-between items-center"
  >
    Edit Footer
    <span>
      <svg
        v-if="!showFooterEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>

  <!-- Dropdown Content -->
  <div v-if="showFooterEditor" class="px-4 py-4">
    <label class="block mb-1 font-medium">Footer Text</label>
    <input
      v-model="footerText"
      type="text"
      class="w-full border rounded px-3 py-1"
      placeholder="Footer content"
    />
  </div>
        </div>


        <!-- Save Button -->
        <button
          @click="saveAll"
          class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition"
          :disabled="loading"
        >
          {{ loading ? 'Saving...' : 'Save All' }}
        </button>

        <p v-if="message" class="mt-4 text-green-600">{{ message }}</p>
        <p v-if="error" class="mt-4 text-red-600">{{ error }}</p>
      </div>

      <!-- Right: Live Preview -->
      <div class="col-span-12 md:col-span-8 rounded-lg shadow overflow-hidden bg-white">
        <!-- Navbar -->
        <nav class="bg-indigo-700 text-white flex px-6 py-4 gap-6">
          <a
            v-for="(item, index) in navbarItems"
            :key="'nav-' + index"
            :href="item.href || '#'"
            class="hover:underline"
          >
            {{ item.name || 'Menu' }}
          </a>
        </nav>

        <!-- Hero Section -->
        <section
          class="p-20 text-center text-white"
          :style="{
            backgroundImage: 'url(' + heroBackgroundImage + ')',
            backgroundSize: 'cover',
            backgroundPosition: 'center',
          }"
        >
          <h1 class="text-5xl font-bold drop-shadow-lg">{{ heroTitle }}</h1>
          <p class="mt-4 text-xl drop-shadow-md">{{ heroSubtitle }}</p>
        </section>

        <!-- Main Content Section -->
        <section class="p-8">
          <h2 class="text-3xl font-bold mb-4">{{ mainHeading }}</h2>
          <p class="text-gray-700 leading-relaxed whitespace-pre-line">
            {{ mainContent }}
          </p>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white text-center p-4">
          {{ footerText }}
        </footer>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Optional: add scrollbar for long content */
</style>
