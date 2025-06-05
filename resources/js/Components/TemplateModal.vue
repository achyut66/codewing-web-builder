<template>
  <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full relative">
      <button @click="close" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
      <slot />
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  show: Boolean
});
const emit = defineEmits(['close']);
const close = () => emit('close');
</script>
