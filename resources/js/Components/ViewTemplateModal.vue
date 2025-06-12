<template>
  <div
    v-if="show"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    @click="close"
  >
    <div
      :style="modalStyle"
      class="bg-white rounded-lg shadow-lg relative overflow-y-auto"
      @click.stop 
    >
      <button
        @click="close"
        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl z-10"
        aria-label="Close"
      >
        &times;
      </button>
      <div class="p-6">
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  show: Boolean,
  width: {
    type: String,
    default: '600px',
  },
  height: {
    type: String,
    default: '80vh', // scrollable height
  },
  maxWidth: {
    type: String,
    default: '90vw',
  },
});

const emit = defineEmits(['close']);
const close = () => emit('close');

const modalStyle = computed(() => ({
  width: props.width,
  height: props.height,
  maxWidth: props.maxWidth,
}));
</script>
