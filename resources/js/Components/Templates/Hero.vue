<script setup>
import { ref,onMounted  } from 'vue'
import axios from 'axios'
import { usePage } from '@inertiajs/vue3'

const { props } = usePage();
const user = props.auth.user;

const userId = ref(user.id || null);
const templateId = window.location.pathname.split('/').pop()
const datastodisplay = ref([]);

const populateFieldsFromData = (data) => {
  if (!data) return;

  if (data.navbar && Array.isArray(data.navbar)) {
    navbarItems.value = data.navbar;
  }

  if (data.hero) {
    heroTitle.value = data.hero.title || '';
    heroSubtitle.value = data.hero.subtitle || '';
    heroBackgroundImage.value = data.hero.backgroundImage || '';
  }

  if (data.mainContent) {
    mainHeading.value = data.mainContent.heading || '';
    mainContent.value = data.mainContent.content || '';
  }

  if (data.contactContent) {
    contactHeading.value = data.contactContent.heading || '';
    contactContent.value = data.contactContent.content || '';
  }

  if (data.portfolioContent) {
    portfolioHeading.value = data.portfolioContent.heading || '';
    portfolioContent.value = data.portfolioContent.content || '';
  }


  if (data.footer) {
    footerText.value = data.footer.text || '';
  }
};

const fetchDisplayData = async () => {
  try {
    if (!userId.value || !templateId) {
      console.warn('userId and templateId are required');
      return;
    }
    const url =
      route('api.templates.get-by-user') +
      `?user_id=${encodeURIComponent(userId.value)}&template_id=${encodeURIComponent(templateId)}`;

    const response = await fetch(url, {
      headers: {
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      },
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    datastodisplay.value = data.templates || [];

    datastodisplay.value = data.templates || [];
    if (datastodisplay.value.length > 0) {
  populateFieldsFromData(datastodisplay.value[0].data);
}

    // console.log('Data to display:', datastodisplay.value);
  } catch (error) {
    console.error('Error fetching display data:', error);
  }
};

onMounted(() => {
  fetchDisplayData();
});


// Navbar menu
const navbarItems = ref([
  { name: 'Home', href: '/' },
  { name: 'About', href: '/about' },
  { name: 'Contact', href: '/contact' },
  { name: 'Portfolio', href: '/portfolio' },
])

// Hero section
const heroTitle = ref('Hi, I am John Doe')
const heroSubtitle = ref('A passionate web developer')
const heroBackgroundImage = ref('https://images.unsplash.com/photo-1507525428034-b723cf961d3e')

// about content
const mainHeading = ref('About Me')
const mainContent = ref('This is Mr. Achyut Neupane a full stack developer (Laravel,React,Vue,Mysql,MongoDB) has been an experience of 4 years now in the similar feilds. And I am currently working as a full stack developer at Codewing Solutions. I have worked on various projects and have a good understanding of web development. I am always eager to learn new technologies and improve my skills.');

// contact section
const contactHeading = ref('Contact Me')
const contactContent = ref('Email:green.band66@gmail.com:\nPhone: 9861023479\nLinkedIn: https://www.linkedin.com/in/achyut-neupane-123456789/');

// portfolio section
const portfolioHeading = ref('My Portfolio')
const portfolioContent = ref('Here are some of my projects:\n1. Project 1\n2. Project 2\n3. Project 3');

// Footer
const footerText = ref('© 2025 John Doe. All rights reserved.')

// Save states
const message = ref('')
const error = ref('')
const loading = ref(false)
const showNavbarEditor = ref(false)
const showHeroEditor = ref(false)
const showMainEditor = ref(false)
const showContactEditor = ref(false)
const showPortfolioEditor = ref(false)
const showFooterEditor = ref(false)

function addMenuItem() {
  navbarItems.value.push({ name: '', href: '' })
}

function removeMenuItem(index) {
  navbarItems.value.splice(index, 1)
}

// image file save 
const heroImageFile = ref(null);
const selectedHeroImageFile = ref(null);

function onHeroImageChange(event) {
  heroImageFile.value = event.target.files[0];
  const file = event.target.files[0];
  if (file) {
    selectedHeroImageFile.value = file;
    heroBackgroundImage.value = URL.createObjectURL(file); // live preview
  }
}

async function saveAll() {
  loading.value = true;
  message.value = '';
  error.value = '';

  try {
    const formData = new FormData();
    formData.append('template_id', templateId);
    formData.append('user_id', user.id);

    formData.append('navbar', JSON.stringify(navbarItems.value));
    formData.append('hero_title', heroTitle.value);
    formData.append('hero_subtitle', heroSubtitle.value);
    formData.append('main_heading', mainHeading.value);
    formData.append('contact_heading', contactHeading.value);
    formData.append('portfolio_heading', portfolioHeading.value);
    formData.append('main_content', mainContent.value);
    formData.append('contact_content', contactContent.value);
    formData.append('portfolio_content', portfolioContent.value);
    formData.append('footer_text', footerText.value);

    if (heroImageFile.value) {
      formData.append('hero_image', heroImageFile.value);
    }

    await axios.post('/api/templates/update-page', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });

    message.value = 'Content saved successfully!';
    window.location.href = '/dashboard';
  } catch (e) {
    error.value = 'Failed to save content.';
  } finally {
    loading.value = false;
  }
}

</script>
<template>
  <div class="min-h-screen p-6 bg-gray-100 flex flex-col gap-6">
    <div class="grid grid-cols-12 gap-8 max-w-7xl mx-auto">
      <div class="col-span-12 md:col-span-4 bg-white p-6 rounded shadow overflow-auto max-h-screen">
        <!-- navbar section -->
        <div class="mb-6 border rounded shadow">
  <!-- Dropdown Header -->
  <div
    @click="showNavbarEditor = !showNavbarEditor"
    class="cursor-pointer bg-indigo-100 px-4 py-2 font-semibold text-indigo-800 flex justify-between"
  >
     Navbar Menu
    <span>
      <svg
        v-if="!showNavbarEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>

  <!-- Dropdown Content -->
  <div v-if="showNavbarEditor" class="px-4 py-4">
    <div
      v-for="(item, index) in navbarItems"
      :key="index"
      class="flex gap-1 mb-3"
    >
      <input
        v-model="item.name"
        type="text"
        placeholder="Menu Text"
        class="w-16 border rounded px-2 py-1 flex-1"
      />
      <input
        v-model="item.href"
        type="text"
        placeholder="URL"
        class="w-16 border rounded px-3 py-1 flex-1"
      />
      <button
        @click="removeMenuItem(index)"
        class="bg-red-600 text-white px-2 rounded hover:bg-red-700"
      >
        &times;
      </button>
    </div>
    <button
      @click="addMenuItem"
      class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700"
    >
      + Menu
    </button>
  </div>
        </div>
        <!-- Hero Section -->
        <div class="mb-6 border rounded shadow">
  <!-- Dropdown Header -->
  <div
    @click="showHeroEditor = !showHeroEditor"
    class="cursor-pointer bg-indigo-100 px-4 py-2 font-semibold text-indigo-800 flex justify-between"
  >
    Hero Section
    <span>
      <svg
        v-if="!showHeroEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>
  <!-- Dropdown Content -->
  <div v-if="showHeroEditor" class="px-4 py-4">
    <label class="block mb-1 font-medium">Title</label>
    <input
      v-model="heroTitle"
      type="text"
      class="w-full mb-2 border rounded px-3 py-1"
      placeholder="Hero title"
    />
    <label class="block mb-1 font-medium">Subtitle</label>
    <input
      v-model="heroSubtitle"
      type="text"
      class="w-full mb-2 border rounded px-3 py-1"
      placeholder="Hero subtitle"
    />

    <label class="block mb-1 font-medium">Background Image</label>
    <input
      type="file"
      class="w-full border rounded px-3 py-1"
      @change="onHeroImageChange"
    />
  </div>
</div>
        <!-- Main Content Section -->
<div class="mb-6 border rounded shadow">
  <!-- Dropdown Header -->
  <div
    @click="showMainEditor = !showMainEditor"
    class="cursor-pointer bg-indigo-100 px-4 py-2 font-semibold text-indigo-800 flex justify-between items-center"
  >
    About Section
    <span>
      <svg
        v-if="!showMainEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>
  <!-- Dropdown Content -->
  <div v-if="showMainEditor" class="px-4 py-4">
    <label class="block mb-1 font-medium">Heading</label>
    <input
      v-model="mainHeading"
      type="text"
      class="w-full mb-2 border rounded px-3 py-1"
      placeholder="Main heading"
    />

    <label class="block mb-1 font-medium">Content</label>
    <textarea
      v-model="mainContent"
      rows="4"
      class="w-full border rounded px-3 py-2"
      placeholder="Write main content..."
    />
  </div>
</div>
<!-- contact section -->
 <div class="mb-6 border rounded shadow">
  <!-- Dropdown Header -->
  <div
    @click="showContactEditor = !showContactEditor"
    class="cursor-pointer bg-indigo-100 px-4 py-2 font-semibold text-indigo-800 flex justify-between items-center"
  >
    Contact Section
    <span>
      <svg
        v-if="!showContactEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>
  <!-- Dropdown Content -->
  <div v-if="showContactEditor" class="px-4 py-4">
    <label class="block mb-1 font-medium">Heading</label>
    <input
      v-model="contactHeading"
      type="text"
      class="w-full mb-2 border rounded px-3 py-1"
      placeholder="Main heading"
    />

    <label class="block mb-1 font-medium">Content</label>
    <textarea
      v-model="contactContent"
      rows="4"
      class="w-full border rounded px-3 py-2"
      placeholder="Write main content..."
    />
  </div>
</div>
<!-- contact section ends here -->

<!-- portfolio section -->
 <div class="mb-6 border rounded shadow">
  <!-- Dropdown Header -->
  <div
    @click="showPortfolioEditor = !showPortfolioEditor"
    class="cursor-pointer bg-indigo-100 px-4 py-2 font-semibold text-indigo-800 flex justify-between items-center"
  >
    Portfolio Section
    <span>
      <svg
        v-if="!showPortfolioEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>
  <!-- Dropdown Content -->
  <div v-if="showPortfolioEditor" class="px-4 py-4">
    <label class="block mb-1 font-medium">Heading</label>
    <input
      v-model="portfolioHeading"
      type="text"
      class="w-full mb-2 border rounded px-3 py-1"
      placeholder="Main heading"
    />

    <label class="block mb-1 font-medium">Content</label>
    <textarea
      v-model="portfolioContent"
      rows="4"
      class="w-full border rounded px-3 py-2"
      placeholder="Write main content..."
    />
  </div>
</div>
<!-- portfolio section ends here -->
        <!-- Footer -->
        <div class="mb-6 border rounded shadow">
  <!-- Toggle Header -->
  <div
    @click="showFooterEditor = !showFooterEditor"
    class="cursor-pointer bg-indigo-100 px-4 py-2 font-semibold text-indigo-800 flex justify-between items-center"
  >
    Footer
    <span>
      <svg
        v-if="!showFooterEditor"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </span>
  </div>

  <!-- Dropdown Content -->
  <div v-if="showFooterEditor" class="px-4 py-4">
    <label class="block mb-1 font-medium">Footer Text</label>
    <input
      v-model="footerText"
      type="text"
      class="w-full border rounded px-3 py-1"
      placeholder="Footer content"
    />
  </div>
        </div>


        <!-- Save Button -->
        <button
          @click="saveAll"
          class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition"
          :disabled="loading"
        >
          {{ loading ? 'Saving...' : 'Save All' }}
        </button>

        <p v-if="message" class="mt-4 text-green-600">{{ message }}</p>
        <p v-if="error" class="mt-4 text-red-600">{{ error }}</p>
      </div>

      <!-- Right: Live Preview -->
      <div class="col-span-12 md:col-span-8 rounded-lg shadow overflow-hidden bg-white">
        <!-- Navbar -->
        <nav class="bg-indigo-700 text-white flex px-6 py-4 gap-6">
          <a
            v-for="(item, index) in navbarItems"
            :key="'nav-' + index"
            :href="item.href || '#'"
            class="hover:underline"
          >
            {{ item.name || 'Menu' }}
          </a>
        </nav>

        <!-- Hero Section -->
        <section
          class="p-20 text-center text-white"
          :style="{
            backgroundImage: 'url(' + heroBackgroundImage + ')',
            backgroundSize: 'cover',
            backgroundPosition: 'center',
          }"
        >
          <h1 class="text-5xl font-bold drop-shadow-lg">{{ heroTitle }}</h1>
          <p class="mt-4 text-xl drop-shadow-md">{{ heroSubtitle }}</p>
        </section>

        <!-- About Section -->
        <section class="p-8 bg-gray-200">
          <h2 class="text-2xl font-bold mb-4 text-center">{{ mainHeading }}</h2>
          <p class="text-gray-700 leading-relaxed whitespace-pre-line">
            {{ mainContent }}
          </p>
        </section>
        <!-- Contact section -->
         <section class="p-8 bg-gray-100">
          <h2 class="text-3xl font-bold mb-4 text-center">{{ contactHeading }}</h2>
          <p class="text-gray-700 leading-relaxed whitespace-pre-line text-center">
            {{ contactContent }}
          </p>
        </section>
        <!-- portfolio section -->
         <section class="p-8 bg-gray-200">
          <h2 class="text-3xl font-bold mb-4 text-center">{{ portfolioHeading }}</h2>
          <p class="text-gray-700 leading-relaxed whitespace-pre-line text-center">
            {{ portfolioContent }}
          </p>
          
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white text-center p-4">
          {{ footerText }}
        </footer>
      </div>
    </div>
  </div>
</template>

