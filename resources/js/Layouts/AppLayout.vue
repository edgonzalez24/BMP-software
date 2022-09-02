<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Components/Banner.vue';
import Sidebar from '@/Components/Shared/Sidebar.vue';
import { ref, watch } from 'vue';
import { useWindowSize } from '@vueuse/core'

const { width } = useWindowSize();

defineProps({
	title: String,
});

const statusMenu = ref(true);

const changeStatus = status => {
	statusMenu.value = status;
};

const handleResize = () => {
	if (width.value > 769) {
		statusMenu.value = true;
	} else {
		statusMenu.value = false;
	}
}
handleResize();

watch(width, () => {
	handleResize();
});
</script>

<template>
	<div>

		<Head :title="title" />

		<JetBanner />

		<div class="min-h-screen bg-gray-100">

			<!-- Page Content -->
			<main class="w-full flex flex-wrap">
				<div class="md:w-2/6 lg:w-1/6 w-full">
					<Sidebar :statusMenu="statusMenu" @changeStatus="changeStatus" />
				</div>
				<div class="md:w-4/6 lg:w-5/6 w-full">
					<!-- Page Heading -->
					<header v-if="$slots.header" class="bg-white shadow">
						<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
							<slot name="header" />
							<div class="md:hidden block" @click="statusMenu = !statusMenu">
								<font-awesome-icon icon="fa-solid fa-bars" class="text-xl text-gray-400 cursor-pointer" />
							</div>
						</div>
					</header>
					<slot />
				</div>
			</main>
		</div>
	</div>
</template>
