<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage,router } from '@inertiajs/vue3';
import { ref,onMounted } from 'vue';
import Button from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/TemplateModal.vue';
import Layout from '@/Layouts/Layouts.vue';
import { useForm } from '@inertiajs/vue3';


const { props } = usePage();
const user = props.auth.user;
const userId = ref(user.id || null);
const flag = ref(user.flag || null);
// console.log(userId.value);
// fetch from only user_id
const userIdData = ref([]);
// console.log(userIdData);
const fetchUserId = async () => {
  try {
    const url = route('api.templates.get-by-user-id') + `?user_id=${encodeURIComponent(userId.value)}`;
    const response = await fetch(url, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
    });

    if (!response.ok) throw new Error('Failed to fetch user data');
    const data = await response.json();
    userIdData.value = data.templates;  // <-- here is the array only
  } catch (error) {
    console.error('Error fetching user ID:', error);
  }
};

onMounted(() => {
  fetchUserId();
});




const isModalOpen = ref(false);
const closeModal = () => (isModalOpen.value = false);

const isViewModalOpen = ref(false);
const closeViewModal = () => (isViewModalOpen.value = false);

const form = ref({
  title: '',
  description: '',
  domain: '',
  design: 'new',
  user_id: userId.value, // Use the fetched user ID
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

// Open the view modal
const selectedTemplate = ref(null);

const openViewModal = (templateId) => {
  const template = userIdData.value.find(t => t.id === templateId);
  if (template) {
    selectedTemplate.value = template;
    isViewModalOpen.value = true;
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
      user_id: userId.value, // Reset to the fetched user ID
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
   
    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
   
      <!-- Content Area -->
      <main class="p-6 space-y-6">
        <section>
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">My Sites</h2>
            <Button @click="openModal">Create</Button>
          </div>

          <!-- Template Cards -->
          <!-- Template Cards -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div 
            v-if="userIdData.length === 0" 
            class="col-span-1 sm:col-span-2 lg:col-span-3 text-center p-4 bg-white shadow rounded-lg"
          >
            <p class="text-gray-500">
              No templates found. Click "Create" to add a new template.
            </p>
          </div>

            <template v-for="template in userIdData" :key="template.id">
              <div class="bg-white p-4 shadow rounded-lg group relative transform transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                <img
                  v-if="template.thumbnail"
                  :src="template.thumbnail" 
                  alt="Template Image"
                  class="w-full h-32 object-cover rounded-md mb-2"
                />
                <img
                  v-else
                  src="/images/default-template.png"
                  alt="Default Template Image"
                  class="w-full h-32 object-cover rounded-md mb-2"
                />
                <h3 class="text-md font-semibold text-gray-800">{{ template.title }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ template.description }}</p>
                <p class="text-xs text-gray-400 mt-1">
                  Last updated: {{ new Date(template.updated_at || template.created_at).toLocaleDateString() }}
                </p>

                <div
                  class="absolute bottom-4 right-4 space-x-2 opacity-0 group-hover:opacity-100 transition-opacity"
                >
                  <Button
                  @click="openViewModal(template.id)"
                  class="px-3 py-2 text-sm bg-gray-700 text-gray-900 rounded hover:bg-gray-300"
                  >
                    View
                  </Button>
                  <Link
                    :href="`/get-templates/${template.id}`"
                    class="px-3 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
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

      <!-- view modal -->
       <Modal :show="isViewModalOpen" @close="closeViewModal">
  <template #default>
    <div v-if="selectedTemplate">
      <h2 class="text-lg font-bold mb-2">{{ selectedTemplate.title }}</h2>
      <p class="text-sm text-gray-600 mb-4">{{ selectedTemplate.description }}</p>
      <img
        v-if="selectedTemplate.thumbnail"
        :src="selectedTemplate.thumbnail"
        alt="Thumbnail"
        class="w-full h-48 object-cover rounded"
      />
      <p class="text-sm text-gray-500 mt-4">
        Domain: {{ selectedTemplate.domain || 'N/A' }}
      </p>
    </div>
    <div v-else>
      <p class="text-gray-500">No template selected.</p>
    </div>
  </template>
</Modal>

    </div>
  </div>
  </Layout>
</template>
