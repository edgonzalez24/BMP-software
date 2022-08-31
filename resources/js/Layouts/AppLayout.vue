<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Components/Banner.vue';
import Sidebar from '@/Components/Shared/Sidebar.vue';
defineProps({
	title: String,
});
</script>

<template>
	<div>

		<Head :title="title" />

		<JetBanner />

		<div class="min-h-screen bg-gray-100">

			<!-- Page Content -->
			<main class="w-full flex flex-wrap">
				<div class="md:w-1/6 w-full">
					<Sidebar />
				</div>
				<div class="md:w-5/6 w-full">
					<!-- Page Heading -->
					<header v-if="$slots.header" class="bg-white shadow">
						<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
							<slot name="header" />
							<div class="md:hidden block">
								Menu
							</div>
						</div>
					</header>
					<slot />
				</div>
			</main>
		</div>
	</div>
</template>
