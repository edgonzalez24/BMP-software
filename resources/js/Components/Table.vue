<script setup>
  defineProps({
    header: Array,
  })
</script>


<template>
  <div class="">
    <table class="sm:table-fixed table-auto overflow-x-scroll w-full">
      <thead class="border-b border-gray-300">
        <tr>
          <th 
            v-for="item in header" class="py-4 md:text-base text-sm" 
            :class="{'hidden lg:block': !item.showInMobile }"
          >
            {{ item.name }}
          </th>
        </tr>
      </thead>
      <slot />
    </table>
  </div>
</template>