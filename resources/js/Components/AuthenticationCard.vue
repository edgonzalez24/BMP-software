<script setup>
import imageLogin from '@/Assets/images/image-login.png';
import imageRecovery from '@/Assets/images/image-recovery.png';
import { computed } from 'vue';

const imageBg = computed(() => route().current('login') ? imageLogin : imageRecovery);

</script>

<template>
	<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-200">
		<div class="w-full md:w-2/3 xl:w-1/2 mt-6 bg-white md:shadow-card overflow-hidden sm:rounded-lg flex flex-wrap md:px-0 px-5">
			<div class="w-full md:w-2/5 bg-dark-blue-500 md:rounded-none rounded-md">
				<div class="h-full flex items-center">
					<img :src="imageBg" />
				</div>
			</div>
			<div class="w-full md:w-3/5 px-6 md:py-24 py-10">
				<slot />
			</div>
		</div>
	</div>
</template>
