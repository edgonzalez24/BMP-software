<script setup>
import JetButton from '@/Components/Button.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';
import Loading from 'vue3-loading-overlay';

const emit = defineEmits(['close']);
const props = defineProps({
  user: Number
})
const isLoading = ref(false);
const submit = () => {
  isLoading.value = true
  Inertia.get(route('delete.user', props.user), {
    onFinish: () => {
      emit('close');
      isLoading.value = false;
    }
  });
};
</script>

<template>
  <form @submit.prevent="submit" class="py-8 px-5">
    <Loading :active.sync="isLoading" ></Loading>
    <h2 class="font-semibold md:text-2xl text-lg text-dark-blue-500 leading-tight text-center">¿Esta seguro de eliminar a este usuario?</h2>
    <div class="md:px-5 px-10">
      <p class="mt-5 text-justify text-gray-400">
        Al  eliminar a este miembro se borrará permanentemente del sistema,
        por favor confirmar la acción haciendo click en el botón de 'Eliminar'.
      </p>
      <div class="flex justify-end mt-5">
        <div class="w-auto flex flex-row space-x-4 justify-between">
          <JetButton
            background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
            type="button"
            @click="emit('close')"
          >
            Cancelar
          </JetButton>
          <JetButton
            background="bg-red-600 focus:ring-transparent focus:border-transparent"
            type="submit"
          >
            Eliminar
          </JetButton>
        </div>
      </div>
    </div>
  </form>
</template>