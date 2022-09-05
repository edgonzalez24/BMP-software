<script setup>
import { computed } from 'vue';
const props = defineProps({
	value: String,
	color: String,
	size: String
});
const colorText = computed(() => props.color ? props.color : 'text-black' );
const sizeText = computed(() => props.size ? props.size : 'text-base');
</script>

<template>
	<label class="block font-normal" :class="[colorText, sizeText]">
		<span v-if="value">{{ value }}</span>
		<span v-else>
			<slot />
		</span>
	</label>
</template>
