<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useForm, Head, usePage, router } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layouts.vue';
import HeroSection from '@/Components/Templates/Hero.vue';
import Banners from '@/Components/Templates/Banners.vue';
// const props = usePage().props;
// const selectedTemplate = ref(props.template); // passed from Laravel controller

// const form = reactive({
//   title: selectedTemplate.value.db_info?.title || '',
//   description: selectedTemplate.value.db_info?.description || '',
//   domain: selectedTemplate.value.db_info?.domain || '',
//   sections: [],
//   template_id: selectedTemplate.value.template_id || null,
// });

// const initFormSections = () => {
//   if (selectedTemplate.value.sections) {
//     form.sections = selectedTemplate.value.sections.map(section => ({
//       type: section.type,
//       props: { ...section.props }
//     }));
//   }
// };

// onMounted(() => {
//   initFormSections();
// });

// const loading = ref(false);

// const submitForm = async () => {
//   loading.value = true;

//   const payload = {
//     title: form.title,
//     description: form.description,
//     domain: form.domain,
//     sections: form.sections,
//     template_id: form.template_id,
//   };

//   try {
//     await router.post(route('your-save-endpoint'), payload);
//   } catch (e) {
//     console.error('Form submission error:', e);
//   } finally {
//     loading.value = false;
//   }
// };
</script>

<template>
  <Head title="Build Site" />
  <Layout>
    <div>
    <Banners/>
    <HeroSection />
    </div>
    <!-- <div class="p-6 max-w-4xl mx-auto">
      <h1 class="text-2xl font-bold mb-4">
        Create Website From Template: {{ selectedTemplate.template_name }}
      </h1>

      <div class="space-y-4">
        <div>
          <label class="block font-semibold">Site Title</label>
          <input v-model="form.title" placeholder="Site title" class="input" />
        </div>

        <div>
          <label class="block font-semibold">Site Description</label>
          <textarea v-model="form.description" placeholder="Site description" class="textarea" />
        </div>

        <div>
          <label class="block font-semibold">Domain</label>
          <input v-model="form.domain" placeholder="example.com" class="input" />
        </div>

        <h2 class="text-xl font-semibold mt-6">Sections</h2>

        <div
          v-for="(section, index) in form.sections"
          :key="index"
          class="section-block"
        >
          <h3 class="text-lg font-bold mb-2">{{ section.type.toUpperCase() }} Section</h3>

          <div v-for="(value, key) in section.props" :key="key" class="mb-3">
            <label :for="`${section.type}-${key}`" class="block text-sm font-medium mb-1">
              {{ key }}
            </label>

            <textarea
              v-if="typeof value === 'string' && value.length > 40"
              :id="`${section.type}-${key}`"
              v-model="section.props[key]"
              class="textarea"
            ></textarea>

            <input
              v-else
              :id="`${section.type}-${key}`"
              type="text"
              v-model="section.props[key]"
              class="input"
            />
          </div>
        </div>

        <button
          @click="submitForm"
          :disabled="loading"
          class="btn-primary mt-6"
        >
          {{ loading ? 'Creating...' : 'Create Website' }}
        </button>
      </div>
    </div> -->
  </Layout>
</template>

<!-- <style scoped>
.input {
  border: 1px solid #ccc;
  padding: 0.5rem;
  width: 100%;
  border-radius: 4px;
}
.textarea {
  width: 100%;
  min-height: 60px;
  padding: 0.5rem;
  border-radius: 4px;
  border: 1px solid #ccc;
}
.section-block {
  border: 1px solid #ddd;
  padding: 1rem;
  margin-bottom: 1rem;
  border-radius: 6px;
}
.btn-primary {
  background-color: #2563eb;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  transition: background-color 0.3s;
}
.btn-primary:disabled {
  background-color: #94a3b8;
}
</style> -->
