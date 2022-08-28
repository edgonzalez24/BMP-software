<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Components/Banner.vue';
import JetDropdownLink from '@/Components/DropdownLink.vue';
defineProps({
	title: String,
});

const logout = () => {
	Inertia.post(route('logout'));
};
</script>

<template>
	<div>

		<Head :title="title" />

		<JetBanner />

		<div class="min-h-screen bg-gray-100">

			<!-- Page Heading -->
			<header v-if="$slots.header" class="bg-white shadow">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
					<slot name="header" />
					<form @submit.prevent="logout">
						<JetDropdownLink as="button">
							Log Out
						</JetDropdownLink>
					</form>
				</div>
			</header>

			<!-- Page Content -->
			<main>
				<slot />
			</main>
		</div>
	</div>
</template>
