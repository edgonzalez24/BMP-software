<script setup>
  import JetButton from '@/Components/Button.vue';
  const props = defineProps({
    client: {
      type: Object,
      required: true
    },
    typeClient: {
      type: Array,
      required: true
    },
  });
  const emit = defineEmits(['close']);
  const getTypeClient = id => {
    return props.typeClient.find(item => item.id === id).name
  }
</script>
<template>
  <div class="py-8 px-5">
    <h3 
      class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5"
    >
      {{ client.name }}
    </h3>
    <div class="mt-5">
      <h6 class="font-semibold text-lg text-dark-blue-500">Tipo de Cliente</h6>
      <p> {{ getTypeClient(client.type_client_id) }}</p>
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