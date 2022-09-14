<script setup>
import { Link } from "@inertiajs/inertia-vue3";
defineProps({
  total: Number,
  next: String,
  previous: String,
  page: String
});
const emit = defineEmits(['next', 'previous', 'page']);

const getActive = () => {
  return new URLSearchParams(window.location.search).has('page') ? Number(new URLSearchParams(window.location.search).get('page')) : 1;
}

</script>

<template>
  <div
    class="relative z-0 inline-flex rounded-md shadow-sm"
    aria-label="Pagination"
  >
    <Link
      class="bg-white relative inline-flex items-center w-10 h-10 justify-center border text-sm font-medium border-gray-300 cursor-pointer hover:bg-gray-100 transition duration-300 ease-in-out"
      :href="previous"
    >
      <svg
        aria-hidden="true"
        focusable="false"
        data-prefix="fas"
        data-icon="chevron-left"
        class="h-5 w-5"
        role="img"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 320 512"
      >
        <path
          class="fill-current text-gray-500"
          d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"
        ></path>
      </svg>
    </Link>
    <Link
      v-for="(_, index) in Array.from({ length: total })"
      :key="index"
      class="z-10 bg-white relative inline-flex items-center px-4 py-2 border text-sm font-medium border-gray-300 cursor-pointer hover:bg-gray-100 transition duration-300 ease-in-out"
      :class="
        getActive() === index + 1
          ? 'border-dark-blue-500 text-dark-blue-500 '
          : 'text-gray-400'
      "
      :href="route(page, {'page': index + 1})"
    >
      {{ index + 1 }}
    </Link>
    <Link
      class="bg-white relative inline-flex items-center w-10 h-10 justify-center border text-sm font-medium border-gray-300 cursor-pointer hover:bg-gray-100 transition duration-300 ease-in-out"
      :href="next"
    >
      <svg
        aria-hidden="true"
        focusable="false"
        data-prefix="fas"
        data-icon="chevron-right"
        class="h-5 w-5"
        role="img"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 320 512"
      >
        <path
          class="fill-current text-gray-500"
          fill="currentColor"
          d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"
        ></path>
      </svg>
    </Link>
  </div>
</template>
