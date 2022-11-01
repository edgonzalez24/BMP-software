<script setup>
  import JetButton from '@/Components/Button.vue';
  const props = defineProps({
    client: {
      type: Object,
      required: true
    },
  });
  const emit = defineEmits(['close']);
</script>
<template>
  <div class="py-8 px-5">
    <h3 
      class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5"
    >
      {{ client.name }}
    </h3>
    <div class="flex flex-row space-x-4 justify-between">
      <div class="mt-5">
        <h6 class="font-semibold text-lg text-dark-blue-500">Tipo de Cliente</h6>
        <p> {{ client.type_client.name }}</p>
      </div>
      <div v-if="client && client.type_client.id === 2" class="mt-5">
        <h6 class="font-semibold text-lg text-dark-blue-500">Zona</h6>
        <p> {{ client.zone.name }}</p>
      </div>
    </div>
    <div class="mt-5">
      <h6 class="font-semibold text-lg text-dark-blue-500">Comentario</h6>
      <p v-html="client.comment"></p>
    </div>
    <div class="flex justify-end mt-5">
      <div class="w-auto">
        <JetButton type="button" @click="emit('close')">
          Entendido!
        </JetButton>
      </div>
    </div>
  </div>
</template>