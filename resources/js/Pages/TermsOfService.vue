<script setup>
import { onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
  terms: String,
});
onMounted(() => {
  Inertia.get('/')
})
</script>

<template>
</template>
