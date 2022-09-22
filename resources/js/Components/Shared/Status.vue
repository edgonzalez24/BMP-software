<script setup>
import { computed } from 'vue';

const props = defineProps({
  status: Number
})

const styles = computed(() => props.status === 1 ? 'text-green-700 bg-green-300' : 'text-red-700 bg-red-300' )
</script>
<template>
  <div class="text-xs rounded-full px-1 py-0.5" :class="styles">
    {{ status === 1  ? 'Activo' : 'Inactivo' }}
  </div>
</template>