<script setup>
import JetButton from '@/Components/Button.vue';
import { ref, getCurrentInstance } from 'vue';
import Loading from 'vue3-loading-overlay';
import { POSITION } from 'vue-toastification';
import { useForm, usePage } from '@inertiajs/inertia-vue3';

const emit = defineEmits(['close']);
const props = defineProps({
  user: Number
});

const isLoading = ref(false);
const form = useForm()
const route = window.route;
const toast = getCurrentInstance().appContext.config.globalProperties.$toast

const submit = () => {
  isLoading.value = true;
  route && form.get(route('delete.user', props.user), {
    onSuccess: () => {
      toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
    },
    onError: () => {
      const errors = usePage().props.value.errors;
      for (const key in errors) {
        if (Object.hasOwnProperty.call(errors, key)) {
          toast.error(errors[key], { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
        }
      }
    },
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
    <div class="px-5">
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