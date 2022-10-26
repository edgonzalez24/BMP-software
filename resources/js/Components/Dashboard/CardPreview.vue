<script setup>
import { computed } from 'vue';

  const props = defineProps({
    value: Object
  });
  const styles = computed(() => {
    let val = {};
    if(props.value.kind === 'orders') {
      val.icon = 'fa-bag-shopping'
      val.iconColor = '#22C55E'
      val.bg = '#86EFAC'
    }
    if (props.value.kind === 'completed') {
      val.icon = 'fa-cart-shopping'
      val.iconColor = '#F7B924'
      val.bg = '#FDF1D3'
    }
    if (props.value.kind === 'presales') {
      val.icon = 'fa-sack-dollar'
      val.iconColor = '#3B82F6'
      val.bg = '#93C5FD'
    }
    return val
  })
</script>
<template>
  <div class="rounded-lg overflow-hidden shadow-card px-5 py-8 bg-white border border-gray-50">
    <div class="flex justify-center">
      <div class="h-8 w-8 rounded-md flex justify-center items-center" :style="{ backgroundColor: styles.bg}">
        <font-awesome-icon :icon="`fa-solid ${styles.icon}`" :style="{ color: styles.iconColor }" class="text-white" />
      </div>
    </div>
    <h6 class="text-center my-3 font-semibold md:text-2xl text-lg text-dark-blue-500">
      {{ value.value }}
    </h6>
    <p class="text-center font-normal md:text-xl text-base text-dark-blue-500">
      {{ value.description }}
    </p>
  </div>
</template>