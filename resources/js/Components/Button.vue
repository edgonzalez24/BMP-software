<script setup>
defineProps({
	type: {
		type: String,
		default: 'submit',
	},
	background: {
		type: String,
		default: 'bg-dark-blue-500 focus:ring-gray-300 focus:border-gray-900 hover:bg-gray-700 active:bg-gray-900'
	},
	color: {
		type: String,
		default: 'text-white'
	}
});
</script>

<template>
	<button :type="type"
		:class="[background, color]"
		class="inline-flex items-center px-8 py-2 border border-transparent rounded-md font-semibold sm:text-base text-sm  tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition">
		<slot />
	</button>
</template>
