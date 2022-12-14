<script setup>
import { Head, usePage, Link } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Components/Banner.vue';
import Sidebar from '@/Components/Shared/Sidebar.vue';
import { computed, ref, watch, onMounted } from 'vue';
import { useWindowSize } from '@vueuse/core';
import JetDropdown from '@/Components/Dropdown.vue';
import { getInitials } from '@/Helpers/Functions.js';

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

const userName = computed(() => usePage().props.value.user.name)
</script>

<template>
	<div>

		<Head title="Dashboard" />

		<JetBanner />

		<div class="min-h-screen bg-gray-100">

			<!-- Page Content -->
			<main class="w-full flex flex-wrap">
				<div class="md:w-3/12 lg:w-1/6 w-full">
					<Sidebar :statusMenu="statusMenu" @changeStatus="changeStatus" />
				</div>
				<div class="md:w-9/12	lg:w-5/6 w-full">
					<!-- Page Heading -->
					<header class="bg-white shadow">
						<div class="max-w-7xl mx-auto py-6 md:py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
							<div class="flex items-center h-full">
								<a href="https://github.com/edgonzalez24/BMP-software" target="_blank" class="text-gray-400 hover:text-dark-blue-500 inline-flex items-center text-sm transition duration-500 ease-in-out">
									<svg class="fill-current h-8 w-8 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
										<path
											d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z" />
									</svg>
									Github
								</a>
							</div>
							<div class="flex items-center">
								<div class="relative">			
									<JetDropdown>
										<template #trigger>
											<a href="#" class="flex items-center">
												
												<div class="h-10 w-10 rounded-full bg-dark-blue-500 flex items-center justify-center text-white">
													{{ getInitials(userName) }}
												</div>
												<font-awesome-icon icon="fa-solid fa-chevron-down" class="md:flex hidden text-xl text-gray-400 cursor-pointer pl-2" />
											</a>
										</template>
										<template #content>
											<div class="flex flex-col">
												<Link :href="'/dashboard/profile'" class="text-gray-400 p-2 hover:bg-slate-50">
													Perfil
												</Link>
											</div>
										</template>
									</JetDropdown>
								</div>
								<div class="md:hidden block ml-2" @click="statusMenu = !statusMenu">
									<font-awesome-icon icon="fa-solid fa-bars" class="text-2xl text-gray-400 cursor-pointer" />
								</div>
							</div>
						</div>
					</header>
					<slot />
				</div>
			</main>
		</div>
	</div>
</template>
