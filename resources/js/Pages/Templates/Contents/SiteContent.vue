<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useForm, Head, usePage, router } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layouts.vue';
import HeroSection from '@/Components/Templates/Hero.vue';
import Banners from '@/Components/Templates/Banners.vue';

</script>

<template>
  <Head title="Build Site" />
  <Layout>
    <div>
    <Banners/>
    <HeroSection />
    </div>
  </Layout>
</template>

