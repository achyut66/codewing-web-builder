<script setup>
import { Link, Head } from '@inertiajs/vue3'
import { ref, onMounted, nextTick } from 'vue'

const featuresRef = ref(null)
const pricingRef = ref(null)
const contactRef = ref(null)
const homeRef = ref(null)

const currentYear = new Date().getFullYear()

const scrollTo = (el) => {
  nextTick(() => {
    if (el) {
      el.scrollIntoView({ behavior: 'smooth' })
    } else {
      console.warn('Element is null:', el)
    }
  })
}

onMounted(() => {
  console.log('featuresRef:', featuresRef.value)
  console.log('pricingRef:', pricingRef.value)
  console.log('contactRef:', contactRef.value)
})
</script>

<template>
  <Head title="Welcome" />
  <div class="min-h-screen flex flex-col bg-gray-50 text-gray-800 scroll-smooth">
    <nav class="bg-white shadow sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
          <div class="flex items-center space-x-3">
            <img src="/build/images/logo.png" alt="Logo" class="h-10 w-10" />
            <span class="text-xl font-bold text-blue-600">Codewing Website Builder</span>
          </div>
          <div class="hidden md:flex items-center space-x-6">
            <button @click="scrollTo(homeRef)" class="hover:text-blue-600 font-medium">Home</button>
            <button @click="scrollTo(featuresRef)" class="hover:text-blue-600 font-medium">Features</button>
            <button @click="scrollTo(pricingRef)" class="hover:text-blue-600 font-medium">Pricing</button>
            <button @click="scrollTo(contactRef)" class="hover:text-blue-600 font-medium">Contact</button>
            <Link href="/login" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Login</Link>
          </div>
        </div>
      </div>
    </nav>

    <header ref="homeRef" class="flex-grow flex items-center justify-center text-center px-4 min-h-[80vh]">
      <div class="max-w-2xl animate-fade-in">
        <h1 class="text-5xl font-extrabold mb-4 leading-tight">Build your dream website in minutes</h1>
        <p class="text-lg text-gray-600 mb-6">Codewing Website Builder lets you design, publish, and manage your site — no coding needed.</p>
        <div class="flex justify-center space-x-4">
          <Link href="/register" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">Get Started Free</Link>
          <Link href="/demo" class="text-blue-600 hover:underline font-medium py-3 px-6">View Demo</Link>
        </div>
      </div>
    </header>

    <section ref="featuresRef" class="py-20 bg-white animate-fade-in">
      <div class="max-w-5xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-6 text-blue-600">Features</h2>
        <p class="text-gray-600 mb-8">Powerful tools to help you design faster and better.</p>
        <div class="grid md:grid-cols-3 gap-8">
          <div class="p-6 shadow rounded-lg bg-gray-50">Drag-and-drop Builder</div>
          <div class="p-6 shadow rounded-lg bg-gray-50">Responsive Templates</div>
          <div class="p-6 shadow rounded-lg bg-gray-50">Custom Domain Support</div>
        </div>
      </div>
    </section>

    <section ref="pricingRef" class="py-20 bg-gray-100 animate-fade-in">
      <div class="max-w-5xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-6 text-blue-600">Pricing</h2>
        <p class="text-gray-600 mb-8">Affordable plans for everyone.</p>
        <div class="grid md:grid-cols-3 gap-8">
          <div class="p-6 bg-white shadow rounded-lg">
            <h3 class="font-bold text-xl mb-2">Free</h3>
            <p>$0/month</p>
          </div>
          <div class="p-6 bg-white shadow rounded-lg">
            <h3 class="font-bold text-xl mb-2">Pro</h3>
            <p>$12/month</p>
          </div>
          <div class="p-6 bg-white shadow rounded-lg">
            <h3 class="font-bold text-xl mb-2">Business</h3>
            <p>$25/month</p>
          </div>
        </div>
      </div>
    </section>

    <section ref="contactRef" class="py-20 bg-white animate-fade-in">
      <div class="max-w-3xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-6 text-blue-600">Contact</h2>
        <p class="text-gray-600 mb-4">Have questions? We'd love to hear from you.</p>
        <p>Email: <a href="mailto:support@codewing.com" class="text-blue-600 hover:underline">support@codewing.com</a></p>
      </div>
    </section>

    <footer class="bg-white text-center py-4 text-sm text-gray-500 border-t">
      &copy; {{ currentYear }} Codewing Website Builder. All rights reserved.
    </footer>
  </div>
</template>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(15px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.8s ease-out;
}
</style>
