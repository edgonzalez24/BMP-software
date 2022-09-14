<script setup>
import JetLabel from '@/Components/Label.vue';
import JetInput from '@/Components/Input.vue';
import JetButton from '@/Components/Button.vue';
import Loading from 'vue3-loading-overlay';
import { computed, ref } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { POSITION } from 'vue-toastification';

const emit = defineEmits(['close']);
const props = defineProps({
  isEdit: Boolean,
  user: Object
})

const roles = computed(() => usePage().props.value.roles);
const isLoading = ref(false);

const getInfoRol = rol => {
  return rol && rol.length > 0 ? roles.value.find(item => item.name === rol[0]) : null;
}
const form = useForm({
  name: props.isEdit && props.user.name || null,
  email:  props.isEdit && props.user.email || null,
  role_id:  props.isEdit && getInfoRol(props.user.user_role).id || null,
});
const submit = () => {
  isLoading.value = true;
  if (props.isEdit) {
    form.transform(data => ({
      ...data,
      user_id: props.user.id
    })).post(route('change.role'), {
      onSuccess: () => {
        this.$toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
        emit('close')
      },
      onError: () => {
        const errors = usePage().props.value.errors;
        for (const key in errors) {
          if (Object.hasOwnProperty.call(errors, key)) {
            this.$toast.error(errors[key], { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
          }
        }
      },
      onFinish: () => {
        isLoading.value = false
      }
    });
  } else {
    form.post(route('invite.user'), {
      onSuccess: () => {
        this.$toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
        emit('close')
      },
      onError: () => {
        const errors = usePage().props.value.errors;
        for (const key in errors) {
          if (Object.hasOwnProperty.call(errors, key)) {
            this.$toast.error(errors[key], { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
          }
        }
      },
      onFinish: () => {
        isLoading.value = false
      }
    });
  }
};
</script>

<template>
  <form class="py-8 px-5" @submit.prevent="submit">
    <Loading :active.sync="isLoading" ></Loading>
    <h2 class="font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5">
      {{ isEdit ? 'Editar usuario' : 'Invitar a usuario' }}
    </h2>
    <div class="mb-5">
      <JetLabel for="name" value="Nombre" />
      <JetInput
        id="name"
        v-model="form.name"
        type="text"
        class="mt-1 block w-full"
        required
        autofocus
        :onlyRead="isEdit"
      />
    </div>
    <div class="mb-5">
      <JetLabel for="email" value="Correo Electrónico" />
      <JetInput
        id="email"
        v-model="form.email"
        type="email"
        class="mt-1 block w-full"
        required
        autofocus
        :onlyRead="isEdit"
      />
    </div>
    <div class="mb-8">
      <JetLabel for="rol" value="Rol" />
      <v-select
        v-model="form.role_id"
        :options="roles.length ? roles : []"
        :reduce="(option) => option.id"
        label="name"
        placeholder="Seleccionar un rol"
        class="appearance-none capitalize"
      >
        <template #open-indicator="{ attributes }">
          <svg
            v-bind="attributes"
            width="10"
            height="7"
            viewBox="0 0 10 7"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M4.95 6.3L0 1.3L1.283 0L4.95 3.706L8.617 0L9.9 1.3L4.95 6.3Z"
              fill="#A4AFB7"
            />
          </svg>
        </template>
        <template #option="{ name }">
          <span class="capitalize">{{ name }}</span>
        </template>
      </v-select>
    </div>
    <div class="flex justify-end mb-5">
      <div class="w-auto flex flex-row space-x-4 justify-between">
        <JetButton
          background="bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent"
          type="button"
          @click="emit('close')"
        >
          Cancelar
        </JetButton>
        <JetButton
          type="submit"
        >
          {{ isEdit ? 'Editar' : 'Invitar' }}
        </JetButton>
      </div>
    </div>
  </form>
</template>