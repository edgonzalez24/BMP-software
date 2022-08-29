<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Components/AuthenticationCard.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetLabel from '@/Components/Label.vue';
import { computed } from 'vue';

defineProps({
  canResetPassword: Boolean,
  status: String,
});


const form = useForm({
  email: null,
  password: null,
  remember: false,
});

const disabledButton = computed(() => !form.email || !form.password);
const errors = computed(() => usePage().props.value.errors);
const hasErrors = computed(() => Object.keys(errors.value).length > 0);

const submit = () => {
  form.transform(data => ({
    ...data,
    remember: form.remember ? 'on' : '',
  })).post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};

</script>

<template>

  <Head title="Iniciar Sesion" />

  <JetAuthenticationCard>
    <form @submit.prevent="submit">
      <h2 class="font-poppins font-bold text-dark-blue-500 md:text-3xl text-lg mb-5">
        Iniciar Sesión
      </h2>
      <div>
        <JetLabel for="email" value="Correo Eléctronico" />
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          :hasErrors="hasErrors"
          required
          autofocus
        />
      </div>

      <div class="mt-4">
        <JetLabel for="password" value="Contraseña" />
        <JetInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          :hasErrors="hasErrors"
          required
          autocomplete="current-password"
        />
      </div>

      <div v-if="hasErrors" class="mt-2">
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
          <li v-for="(error, key) in errors" :key="key">
            {{ error }}
          </li>
        </ul>
      </div>

      <div class="flex justify-end mb-6" :class="{ 'mt-6': !hasErrors }">
        <Link
          :href="route('password.request')"
          class="text-sm text-blue-600 hover:opacity-75"
        >
        ¿Olvidaste tu contraseña?
        </Link>
      </div>
      <JetButton
        :class="{ 'opacity-25': form.processing || disabledButton }"
        :disabled="form.processing || disabledButton"
      >
        Acceder
      </JetButton>
    </form>
  </JetAuthenticationCard>
</template>
