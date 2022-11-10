<script setup>
import { Head, useForm, Link, usePage } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Components/AuthenticationCard.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetLabel from '@/Components/Label.vue';
import { computed } from 'vue';

defineProps({
	status: String,
});

const form = useForm({
	email: '',
});
const disabledButton = computed(() => !form.email);
const errors = computed(() => usePage().props.value.errors);
const hasErrors = computed(() => Object.keys(errors.value).length > 0);
const submit = () => {
	form.post(route('password.email'), {
		onFinish: () => form.reset('email')
	});
};
</script>

<template>

	<Head title="Recuperar contraseña" />

	<JetAuthenticationCard>
		<Link :href="'/'" class="inline-flex items-center mb-2">
			<font-awesome-icon icon="fa-solid fa-arrow-left-long" class="text-base mr-2" />
			Regresar
		</Link>
		<h2 class="font-poppins font-bold text-dark-blue-500 md:text-2xl text-lg mb-5">
			Recuperar contraseña
		</h2>
		<form @submit.prevent="submit">
			<div>
				<JetLabel for="email" value="Correo Eléctronico" class="mb-2" />
				<JetInput
					id="email"
					v-model="form.email"
					type="email"
					class="mt-1 block w-full"
					required
					autofocus
				/>
			</div>
			<div v-if="hasErrors" class="mt-2">
				<ul class="mt-3 text-sm text-dark-blue-500 font-medium">
					<li v-for="(error, key) in errors" :key="key">
						{{ error }}
					</li>
				</ul>
			</div>
			<div v-if="status" class="mt-2">
				<ul class="mt-3 text-sm text-dark-blue-500 font-medium">
					<li>
						{{ status }}
					</li>
				</ul>
			</div>

			<div class="mt-12">
				<JetButton
					:class="{ 'opacity-25': form.processing || disabledButton}"
					:disabled="form.processing || disabledButton"
				>
					Recuperar
				</JetButton>
			</div>
		</form>
	</JetAuthenticationCard>
</template>
