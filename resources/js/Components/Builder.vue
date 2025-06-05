<!-- Builder.vue -->
<template>
  <div v-for="(section, index) in website.sections" :key="index">
    <component :is="resolveComponent(section.type)" :props="section.props" />
  </div>
</template>

<script setup>
import HeroSection from './sections/HeroSection.vue'
import AboutSection from './sections/AboutSection.vue'

const props = defineProps(['website'])

const resolveComponent = (type) => {
  return {
    hero: HeroSection,
    about: AboutSection
  }[type]
}
</script>
