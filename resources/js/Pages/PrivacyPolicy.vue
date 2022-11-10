<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
	policy: String,
});
</script>

<template>

	<Head title="Privacidad - BMP" />

	<div class="font-sans text-gray-900 antialiased">
		<div class="pt-4 bg-gray-100 animated fadeIn">
			<div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 px-5">
				<div class="flex justify-center">
					<Link href="/dashboard" class="underline text-xl font-bold">
						Inicio
					</Link>
				</div>

				<div class="w-full sm:max-w-2xl mt-6 mb-8 p-6 bg-white shadow-xl rounded-lg overflow-hidden prose border border-gray-50 "
					v-html="policy" />
			</div>
		</div>
	</div>
</template>
