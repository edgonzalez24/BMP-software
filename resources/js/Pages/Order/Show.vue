<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import JetButton from '@/Components/Button.vue';
</script>
<template>
  <AppLayout>
    <div class="min-h-screen">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center my-5">
          <h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight">
            Pedidos
          </h2>
          <JetButton @click="true">
            Crear
          </JetButton>
        </div>
      </div>
    </div>
  </AppLayout>
</template>