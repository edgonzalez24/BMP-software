<script setup>
	import AppLayout from '@/Layouts/AppLayout.vue';
	import JetLabel from '@/Components/Label.vue';
	import JetInput from '@/Components/Input.vue';
	import JetButton from '@/Components/Button.vue';
	import Loading from 'vue3-loading-overlay';
	import { useForm, usePage } from '@inertiajs/inertia-vue3';
	import { computed, ref } from 'vue';
	import { useToast, POSITION } from 'vue-toastification';
	import { getInitials } from '@/Helpers/Functions.js';


	const user = computed(() => usePage().props.value.user);

	const toast = useToast();
	const isLoading = ref(false);
	const changePassword = ref(false);
	const showConfirmPassword = ref(false);
	const showCurrentPassword = ref(false);
	const showNewPassword = ref(false);
	const form = useForm({
		_method: 'PUT',
		email: user.value.email,
		name: user.value.name,
		telephone: user.value.telephone,
	});
	const form_password = useForm({
		current_password: '',
		password: '',
		password_confirmation: '',
	});



	const togglePassword = () => {
		changePassword.value = !changePassword.value;
		if(!changePassword.value){
			form_password.current_password = '';
			form_password.password = '';
			form_password.password_confirmation = '';
		}
	}
	const submit = () => {
		isLoading.value = true;
		
		form.post(route('user-profile-information.update'), {
			errorBag: 'updateProfileInformation',
			preserveScroll: true,
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
				if(!changePassword.value) {
					isLoading.value = false;
				}
			}
		});

		if(changePassword.value) {
			form_password.put(route('user-password.update'), {
				errorBag: 'updatePassword',
				preserveScroll: true,
				onSuccess: () => {
					toast.success(usePage().props.value.flash.success, { position: POSITION.BOTTOM_RIGHT, timeout: 5000 });
					form_password.current_password = '';
					form_password.password = '';
					form_password.password_confirmation = '';
				},
				onError: () => {
					const errors = usePage().props.value.errors.updatePassword;
					for (const key in errors) {
						if (Object.hasOwnProperty.call(errors, key)) {
							toast.error(errors[key], { position: POSITION.BOTTOM_RIGHT, timeout: 7000 });
						}
					}
				},
				onFinish: () => {
					isLoading.value = false;
				}
			});
		}
	}
</script>

<template>
	<AppLayout>
		<Loading :active.sync="isLoading" ></Loading>
		<form @submit.prevent="submit" class="min-h-screen">
			<div class="max-w-7xl mx-auto py-10 px-5 sm:px-6 lg:px-8">
				<h1 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight mb-5 animated zoomIn">
          Perfil
        </h1>
				<div class="bg-white overflow-hidden shadow-xl rounded-lg min-h-base px-5 py-10 border border-gray-50 animated fadeIn">
					<div class="flex justify-center">
						<div class="md:w-40 md:h-40 w-24 h-24 bg-dark-blue-500 rounded-full flex justify-center items-center">
							<p class="text-poppins text-white sm:text-3xl text-xl font-bold">{{ getInitials(form.name) }}</p>
						</div>
					</div>
					<div class="flex flex-col md:flex-row md:space-x-6 mt-5 px-2">
						<div class="md:w-1/2 w-full mb-5">
							<JetLabel for="email" value="Correo Electrónico" />
							<JetInput
								id="email"
								v-model="form.email"
								type="email"
								class="mt-1 block w-full"
								required
								autofocus
							/>
						</div>
						<div class="md:w-1/2 w-full mb-5">
							<JetLabel for="name" value="Nombre" />
							<JetInput
								id="name"
								v-model="form.name"
								type="text"
								class="mt-1 block w-full"
								required
								autofocus
							/>
						</div>
					</div>
					<div class="md:w-1/2 w-full mb-5 md:pr-3 px-2">
						<JetLabel for="phone" value="Télefono" />
						<JetInput
							id="phone"
							v-model="form.telephone"
							type="text"
							class="mt-1 block w-full"
							phoneNumber
							autofocus
						/>
					</div>
					
					<div class="mt-5">
						<a
							class="font-semibold md:text-xl text-base text-dark-blue-500 leading-tight mb-5 inline-flex items-center cursor-pointer px-2"
							@click="togglePassword"
						>
							Cambiar contraseña
							<svg
								aria-hidden="true"
								focusable="false"
								data-prefix="fas"
								data-icon="chevron-down"
								class="w-5 h-5 ml-1"
								:class="
									changePassword ? 'efect-rotate-down' : 'efect-rotate-up'
								"
								role="img"
								xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 448 512"
							>
								<path
									fill="currentColor"
									d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"
								></path>
							</svg>
						</a>
						<div :class="changePassword ? 'transition-container-full' : 'transition-container'" class="px-2">
							<div class="md:w-1/2 w-full mb-5 md:pr-3">
								<JetLabel for="current_password" value="Contraseña Actual" />
								<div class="relative">
									<JetInput
										id="current_password"
										v-model="form_password.current_password"
										:type="!showCurrentPassword ? 'password' : 'text'"
										class="mt-1 block w-full"
										:required="changePassword"
										autofocus
									/>
									<div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
										<font-awesome-icon 
											:icon="`fa-solid ${showCurrentPassword ? 'fa-eye' : 'fa-eye-slash'}`"
											class="block text-base text-gray-400 cursor-pointer pl-2" 
											@click="showCurrentPassword= !showCurrentPassword"
										/>
									</div>
								</div>
							</div>
							<div class="flex flex-col md:flex-row md:space-x-6 mt-5">
								<div class="md:w-1/2 w-full mb-5">
									<JetLabel for="new_password" value="Nueva Contraseña" />
									<div class="relative">
										<JetInput
											id="new_password"
											v-model="form_password.password"
											:type="!showNewPassword ? 'password' : 'text'"
											class="mt-1 block w-full"
											:required="changePassword"
											autofocus
										/>
										<div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
											<font-awesome-icon 
												:icon="`fa-solid ${showNewPassword ? 'fa-eye' : 'fa-eye-slash'}`"
												class="block text-base text-gray-400 cursor-pointer pl-2" 
												@click="showNewPassword = !showNewPassword"
											/>
										</div>
									</div>
									
								</div>
								<div class="md:w-1/2 w-full mb-5">
									<JetLabel for="new_password_confirm" value="Confirmar Nueva Contraseña" />
									<div class="relative">
										<JetInput
											id="new_password_confirm"
											v-model="form_password.password_confirmation"
											:type="!showConfirmPassword ? 'password' : 'text'"
											class="mt-1 block w-full"
											:required="changePassword"
											autofocus
										/>
										<div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
											<font-awesome-icon 
												:icon="`fa-solid ${showConfirmPassword ? 'fa-eye' : 'fa-eye-slash'}`"
												class="block text-base text-gray-400 cursor-pointer pl-2" 
												@click="showConfirmPassword = !showConfirmPassword"
											/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="w-48 px-2">
						<JetButton
							type="submit"
							class="w-full flex justify-center"
							>
							Actualizar
						</JetButton>
					</div>
				</div>
			</div>
		</form>
	</AppLayout>
</template>
