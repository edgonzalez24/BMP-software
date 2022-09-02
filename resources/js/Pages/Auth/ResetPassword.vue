<script setup>
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Components/AuthenticationCard.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetLabel from '@/Components/Label.vue';
import { computed } from 'vue';

const props = defineProps({
	email: String,
	token: String,
});

const form = useForm({
	token: props.token,
	email: props.email,
	password: '',
	password_confirmation: '',
});

const disableButton = computed(() => !form.email || !form.password || !form.password_confirmation);
const errors = computed(() => usePage().props.value.errors);
const hasErrors = computed(() => Object.keys(errors.value).length > 0);

const submit = () => {
	form.post(route('password.update'), {
		onFinish: () => form.reset('password', 'password_confirmation'),
	});
};
</script>

<template>

	<Head title="Reestablecer Contraseña" />

	<JetAuthenticationCard>
		<h2 class="font-poppins font-bold text-dark-blue-500 md:text-2xl text-lg mb-5">
			Reestablecer contraseña
		</h2>
		<form @submit.prevent="submit">
			<div>
				<JetLabel for="email" value="Correo Eléctronico" />
				<JetInput
					id="email"
					v-model="form.email"
					:hasErrors="hasErrors"
					type="email"
					class="mt-1 block w-full"
					required
					autofocus
				/>
			</div>

			<div class="mt-4">
				<JetLabel for="password" value="Contraseña" />
				<JetInput
					id="password"
					v-model="form.password"
					:hasErrors="hasErrors"
					type="password"
					class="mt-1 block w-full"
					required
					autocomplete="new-password"
				/>
			</div>

			<div class="mt-4">
				<JetLabel for="password_confirmation" value="Confirmar Contraseña" />
				<JetInput
					id="password_confirmation"
					v-model="form.password_confirmation"
					:hasErrors="hasErrors"
					type="password"
					class="mt-1 block w-full"
					required
					autocomplete="new-password"
				/>
			</div>

			<div v-if="hasErrors" class="mt-2">
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
          <li v-for="(error, key) in errors" :key="key">
            {{ error }}
          </li>
        </ul>
      </div>

			<div class="mt-8">
				<JetButton
					:class="{ 'opacity-25': form.processing || disableButton }"
					:disabled="form.processing || disableButton"
				>
					Reestablecer Contraseña
				</JetButton>
			</div>
		</form>
	</JetAuthenticationCard>
</template>
