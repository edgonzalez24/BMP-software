<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetLabel from '@/Components/Label.vue';
import JetInput from '@/Components/Input.vue';
import JetButton from '@/Components/Button.vue';
import Loading from 'vue3-loading-overlay';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, ref } from 'vue';
import { useToast, POSITION } from 'vue-toastification';

const user = computed(() => usePage().props.value.user);
const toast = useToast();

const isLoading = ref(false);
const form = useForm({
	_method: 'PUT',
	email: user.value.email,
	name: user.value.name,
	telephone: user.value.telephone,
});

const getInitials = (name) => {
	if(name) {
		const names = name.split(' ')
    let initials = names[0].substring(0, 1).toUpperCase();
    if (names.length > 1) {
        initials += names[names.length - 1].substring(0, 1).toUpperCase();
    }
    return initials;
	}
};

const submit = () => {
	isLoading.value = true
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
        isLoading.value = false
      }
	})
}

</script>

<template>
	<AppLayout>
		<Loading :active.sync="isLoading" ></Loading>
		<form @submit.prevent="submit">
			<div class="max-w-7xl mx-auto py-10 px-5 sm:px-6 lg:px-8">
				<h2 class="font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight mb-5">
          Perfil
        </h2>
				<div class="bg-white overflow-hidden shadow-xl rounded-lg min-h-base px-5 py-10">
					<div class="flex justify-center">
						<div class="md:w-40 md:h-40 w-24 h-24 bg-dark-blue-500 rounded-full flex justify-center items-center">
							<p class="text-poppins text-white sm:text-3xl text-xl font-bold">{{ getInitials(form.name) }}</p>
						</div>
					</div>
					<div class="flex flex-col md:flex-row md:space-x-6 mt-5">
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
					<div class="md:w-1/2 w-full mb-5 md:pr-3">
						<JetLabel for="phone" value="Télefono" />
						<JetInput
							id="phone"
							v-model="form.telephone"
							type="text"
							class="mt-1 block w-full"
							required
							autofocus
						/>
					</div>
					<JetButton
						type="submit"
						>
						Guardar
					</JetButton>
				</div>
				<!-- <div v-if="$page.props.jetstream.canUpdateProfileInformation">
					<UpdateProfileInformationForm :user="$page.props.user" />

					<JetSectionBorder />
				</div>

				<div v-if="$page.props.jetstream.canUpdatePassword">
					<UpdatePasswordForm class="mt-10 sm:mt-0" />

					<JetSectionBorder />
				</div>

				<div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
					<TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication" class="mt-10 sm:mt-0" />

					<JetSectionBorder />
				</div>

				<LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />

				<template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
					<JetSectionBorder />

					<DeleteUserForm class="mt-10 sm:mt-0" />
				</template> -->
			</div>
		</form>
	</AppLayout>
</template>
