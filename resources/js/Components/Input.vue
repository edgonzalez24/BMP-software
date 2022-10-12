<script setup>
import { onMounted, ref } from 'vue';

defineProps({
	modelValue: String | Number,
	hasErrors: Boolean,
	onlyRead: Boolean,
	phoneNumber: Boolean
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
	if (input.value.hasAttribute('autofocus')) {
		input.value.focus();
	}
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
	<input
		ref="input"
		class="rounded-md"
		:class="hasErrors ? 'border-red-600 focus:outline-none focus:border-red-600 shadow-none focus:ring-0' : 'border-gray-50 focus:border-gray-400 hover:border-gray-400 focus:ring hover:ring focus:ring-gray-300 hover:ring-gray-300 focus:ring-opacity-50 hover:ring-opacity-50  shadow-sm disabled:bg-slate-50'"
		:value="modelValue"
		:disabled="onlyRead"
		v-maska="phoneNumber && '#### - ####'"
		@input="$emit('update:modelValue', $event.target.value)"
	>
</template>
