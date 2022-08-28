<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Components/AuthenticationCard.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetLabel from '@/Components/Label.vue';
import JetValidationErrors from '@/Components/ValidationErrors.vue';
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

const submit = () => {
  if(!disabledButton) {
    form.transform(data => ({
      ...data,
      remember: form.remember ? 'on' : '',
    })).post(route('login'), {
      onFinish: () => form.reset('password'),
    });
  }
};

</script>

<template>

  <Head title="Iniciar Sesion" />

  <JetAuthenticationCard>

    <JetValidationErrors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <h2
        class="font-poppins font-bold text-dark-blue-500 md:text-3xl text-lg mb-5"
      >
        Iniciar Sesión
      </h2>
      <div>
        <JetLabel
          for="email"
          value="Correo Eléctronico"
        />
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
        />
      </div>

      <div class="mt-4">
        <JetLabel
          for="password"
          value="Contraseña"
        />
        <JetInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
        />
      </div>

      <div class="mt-6">
        <div class="flex justify-end mb-6">
          <Link
            :href="route('password.request')"
            class="text-sm text-blue-600 hover:opacity-75">
            ¿Olvidaste tu contraseña?
          </Link>
        </div>

        <JetButton
          :class="{ 'opacity-25': form.processing || disabledButton }"
          :disabled="form.processing"
        >
          Acceder
        </JetButton>
      </div>
    </form>
  </JetAuthenticationCard>
</template>
