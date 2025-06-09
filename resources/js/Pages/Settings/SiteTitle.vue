<script setup>
import { ref, watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Layout from '@/Layouts/Layouts.vue'
import Modal from '@/Components/TemplateModal.vue'

const props = defineProps({
  settings: Array
})

const isModalOpen = ref(false)

const openModal = () => {
  editingSetting.value = null // reset edit mode
  form.reset()
  isModalOpen.value = true
}

const closeModal = () => {
  isModalOpen.value = false
}

watch(isModalOpen, (val) => {
  document.body.style.overflow = val ? 'hidden' : ''
})

const editingSetting = ref(null)

const form = useForm({
  site_title: '',
  site_description: '',
  site_keywords: '',
  site_logo: null,
  favicon: null
})

const submit = () => {
  if (editingSetting.value) {
    // Add `_method` field to spoof PUT
    form.transform((data) => ({
      ...data,
      _method: 'PUT',
    })).submit('post', route('settings.site-title.update', editingSetting.value.id), {
      onSuccess: () => {
        form.reset()
        editingSetting.value = null
        closeModal()
      }
    })
  } else {
    form.post(route('settings.site-title.store'), {
      onSuccess: () => {
        form.reset()
        closeModal()
      }
    })
  }
}



const editTitle = (setting) => {
  editingSetting.value = setting
  form.site_title = setting.site_title
  form.site_description = setting.site_description
  form.site_keywords = setting.site_keywords
  form.site_logo = null
  form.favicon = null
  isModalOpen.value = true
}

const deleteTitle = (setting) => {
  if (confirm('Are you sure you want to delete this setting?')) {
    form.delete(route('settings.site-title.destroy', setting.id), {
      preserveScroll: true
    })
  }
}
</script>

<template>
  <Layout>
    <div class="max-w-7xl mx-auto mt-10">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Site Settings</h1>
        <button
          @click="openModal"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
          Add Setting
        </button>
      </div>

      <table class="w-full border text-sm text-left bg-white shadow-sm rounded">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Keywords</th>
            <th class="px-4 py-2">Logo</th>
            <th class="px-4 py-2">Favicon</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(setting, index) in props.settings"
            :key="index"
            class="border-t hover:bg-gray-50"
          >
            <td class="px-4 py-2">{{ setting.site_title }}</td>
            <td class="px-4 py-2">{{ setting.site_description }}</td>
            <td class="px-4 py-2">{{ setting.site_keywords }}</td>
            <td class="px-4 py-2">
               <img :src="`/storage/${setting.site_logo}`" alt="Site Logo" class="h-10 w-auto rounded" />
            </td>
            <td class="px-4 py-2">
               <img :src="`/storage/${setting.favicon}`" alt="Site Logo" class="h-10 w-auto rounded" />
            </td>
            <td class="px-4 py-2 space-x-2">
              <button @click="editTitle(setting)" class="text-blue-600 hover:underline">Edit</button>
              <button @click="deleteTitle(setting)" class="text-red-600 hover:underline">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Modal -->
       <div
  v-if="isModalOpen"
  class="fixed inset-0 bg-black bg-opacity-30 z-50"
></div>

      <Modal :show="isModalOpen" @close="closeModal">
        <!-- <template #default> -->
          <div class="space-y-4">
            <h2 class="text-lg font-semibold mb-4">Add New Setting</h2>
            <form @submit.prevent="submit" enctype="multipart/form-data" class="space-y-2">
              <div>
                <label class="block mb-1 font-medium">Site Title</label>
                <input
                  v-model="form.site_title"
                  type="text"
                  class="w-full border px-3 py-2 rounded"
                />
              </div>

              <div>
                <label class="block mb-1 font-medium">Description</label>
                <textarea
                  v-model="form.site_description"
                  class="w-full border px-3 py-2 rounded"
                ></textarea>
              </div>

              <div>
                <label class="block mb-1 font-medium">Keywords</label>
                <input
                  v-model="form.site_keywords"
                  type="text"
                  class="w-full border px-3 py-2 rounded"
                />
              </div>

              <div>
                <label class="block mb-1 font-medium">Site Logo</label>
                <input
                  type="file"
                  class="w-full border px-3 py-2 rounded"
                  @change="(e) => form.site_logo = e.target.files[0]"
                />
              </div>

              <div>
                <label class="block mb-1 font-medium">Favicon</label>
                <input
                  type="file"
                  class="w-full border px-3 py-2 rounded"
                  @change="(e) => form.favicon = e.target.files[0]"
                />
              </div>

              <div class="flex justify-end space-x-2">
                <button
                  type="button"
                  @click="closeModal"
                  class="px-4 py-2 bg-gray-300 rounded"
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                  Save
                </button>
              </div>
            </form>
          </div>
        <!-- </template> -->
      </Modal>
    </div>
  </Layout>
</template>
