<script setup>
  defineProps({
    header: Array,
  })
</script>


<template>
  <div class="w-full">
    <table class="table-fixed w-full">
      <thead class="border-b border-gray-300">
        <tr>
          <th v-for="item in header" class="py-4">{{ item }}</th>
        </tr>
      </thead>
      <slot />
    </table>
  </div>
</template>