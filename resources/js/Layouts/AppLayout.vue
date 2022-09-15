<script setup>
import { Head, usePage, Link } from '@inertiajs/inertia-vue3';
import JetBanner from '@/Components/Banner.vue';
import Sidebar from '@/Components/Shared/Sidebar.vue';
import { computed, ref, watch } from 'vue';
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

		<Head title="Dashboard | BMP" />

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
							<h2 class="font-semibold text-xl text-gray-800 leading-tight">
								Dashboard
							</h2>
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
									<font-awesome-icon icon="fa-solid fa-bars" class="text-xl text-gray-400 cursor-pointer" />
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
