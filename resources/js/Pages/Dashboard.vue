<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage,router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Button from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/TemplateModal.vue';
import Layout from '@/Layouts/Layouts.vue';

const isModalOpen = ref(false);
// const openModal = () => (isModalOpen.value = true);
const closeModal = () => (isModalOpen.value = false);

const form = ref({
  title: '',
  description: '',
  domain: '',
  design: 'new',
  template_id: '',
});

const templates = ref([]);

const openModal = async () => {
  isModalOpen.value = true;

  try {
    const response = await fetch(route('api.templates.fetch'), {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
    });

    const data = await response.json();
    templates.value = data.templates; // This should now be the full array
  } catch (error) {
    console.error('Error fetching templates:', error);
  }
};

const submitForm = async () => {
  try {
    const response = await fetch(route('api.templates.store'), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify(form.value),
    });

    const responseData = await response.json();

    if (!response.ok) {
      console.error('Submit failed:', responseData);
      alert('Error: ' + (responseData.message || 'Unknown error'));
      return;
    }
    const savedId = responseData.template.id;
    console.log('Successfully saved template:', responseData);
    router.visit(route('get-templates', savedId));
    // alert('Template saved!');
    // window.location();

    form.value = {
      title: '',
      description: '',
      domain: '',
      design: '',
      template_id: '',
    };

    closeModal();
  } catch (error) {
    console.error('Error submitting form:', error);
    alert('Submit error: ' + error.message);
  }
};

</script>

<template>
  <Layout>
  <Head title="Dashboard" />

  <div class="min-h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <!-- <aside class="w-64 bg-gray-300 shadow-md hidden md:block">
      <div class="p-6">
        <img src="/build/images/logo.png" alt="Logo" class="h-30 mb-6" />
        <nav class="space-y-4 ml-12">
          <Link href="/dashboard" class="block text-gray-700 font-medium hover:text-blue-600">My Sites</Link>
          <Link href="/templates" class="block text-gray-700 font-medium hover:text-blue-600">Templates</Link>
          <Link href="/settings" class="block text-gray-700 font-medium hover:text-blue-600">Settings</Link>
        </nav>
      </div>
    </aside> -->
    
    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Topbar -->
      <!-- <header class="bg-white shadow-sm p-4 flex items-center justify-between">
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
      </header> -->

      <!-- Content Area -->
      <main class="p-6 space-y-6">
        <section>
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">My Sites</h2>
            <Button @click="openModal">Create</Button>
          </div>

          <!-- Template Cards -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <template v-for="i in 4" :key="i">
              <div class="bg-white p-4 shadow rounded-lg group relative transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                <h3 class="text-md font-semibold text-gray-800">My First Site</h3>
                <p class="text-sm text-gray-500 mt-1">Last updated: June 4, 2025</p>

                <div
                  class="absolute bottom-4 right-4 space-x-2 opacity-0 group-hover:opacity-100 transition-opacity"
                >
                  <Link
                    :href="`/sites/${i}`"
                    class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                  >
                    View
                  </Link>
                  <Link
                    :href="`/sites/${i}/edit`"
                    class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
                  >
                    Edit
                  </Link>
                </div>
              </div>
            </template>
          </div>
        </section>
      </main>

      <!-- Create Template Modal -->
      <Modal :show="isModalOpen" @close="closeModal">
        <h2 class="text-lg font-bold mb-4">Create New Template</h2>

        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input
              v-model="form.title"
              type="text"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
              placeholder="Enter template title"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea
              v-model="form.description"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
              placeholder="Enter template description"
            ></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Domain Name</label>
            <input
              v-model="form.domain"
              type="text"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
              placeholder="e.g., mysite.codewing.com"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Template Design</label>
            <select
              v-model="form.template_id"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
            >
              <option disabled value="">Select a design</option>
              <option v-for="template in templates" :key="template.template_id" :value="template.template_id">
    {{ template.template_name }}
  </option>
            </select>
          </div>

          <div class="flex justify-end space-x-2">
            <button
              @click="submitForm"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
              Save
            </button>
            <button
              @click="closeModal"
              class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
            >
              Cancel
            </button>
          </div>
        </div>
      </Modal>
    </div>
  </div>
  </Layout>
</template>
