<script setup>
defineProps({
	type: {
		type: String,
		default: 'submit',
	},
});
</script>

<template>
	<button :type="type"
		class="inline-flex items-center px-8 py-2 bg-dark-blue-500 border border-transparent rounded-md font-semibold sm:text-base text-sm text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
		<slot />
	</button>
</template>
