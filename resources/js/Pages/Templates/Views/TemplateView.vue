<!-- TemplateGallery.vue -->
 <script setup>
import { ref } from 'vue'
import Layout from '@/Layouts/Layouts.vue'
import { Head, Link, usePage,router } from '@inertiajs/vue3';
const templates = ref([
  {
    name: 'Portfolio Classic',
    description: 'A simple and elegant portfolio layout.',
    thumbnail: '/build/images/portfolio.png',

  },
  {
    name: 'Business Landing',
    description: 'Ideal for business startups or landing pages.',
    thumbnail: 'build/images/business.jpg',
  },
  {
    name: 'Creative Agency',
    description: 'Vibrant design for creative agencies.',
    thumbnail: 'build/images/creative.jpg',
  },
  {
    name: 'Minimal Blog',
    description: 'Clean and modern blogging template.',
    thumbnail: 'build/images/minimal.jpeg',
  },
])

function selectTemplate(template) {
  alert(`Previewing: ${template.name}`)
}
</script>

<template>
    <Head title="ViewTemplates" />
    <Layout>
  <div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-xl text-center font-semibold mb-6">Website Templates</h1>

    <div class="grid grid-cols-12 gap-6">
      <div
        v-for="(template, index) in templates"
        :key="index"
        class="col-span-12 sm:col-span-6 bg-white shadow rounded-lg overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl"
      >
        <img :src="template.thumbnail" alt="Template Image" class="w-full h-48 object-cover" />
        <div class="p-4">
          <h2 class="text-xl font-bold mb-2">{{ template.name }}</h2>
          <p class="text-sm text-gray-600 mb-4">{{ template.description }}</p>
          <button
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
            @click="selectTemplate(template)"
          >
            Preview
          </button>
        </div>
      </div>
    </div>
  </div>
  </Layout>
</template>

