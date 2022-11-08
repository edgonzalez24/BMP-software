<script setup>
import { computed } from 'vue';

const props = defineProps({
  checked: Number,
  label: Boolean,
  activeControl: {
    type: Boolean,
    default: false
  },
});
const emit = defineEmits(['update:checked']);

const proxyChecked = computed({
	get() {
		return props.checked === 1;
	},

	set(val) {
		emit('update:checked', val ? 1 : 0);
	},
});
</script>

<template>
  <div class="w-full relative inline-flex">
    <div class="relative mr-3">
      <p class="text-gray-500 text-sm">
        {{ label ? 'No' : 'Inactivo' }}
      </p>
    </div>
    <label class="flex items-center cursor-pointer">
      <div class="relative">
        <input
          v-model="proxyChecked"
          type="checkbox"
          class="hidden"
          :disabled="activeControl"
        />
        <div
          class="toggle__line w-10 h-4 rounded-full shadow-inner bg-gray-100"
        />
        <div
          class="toggle__dot absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0"
        />
      </div>
      <div class="ml-3 text-dark font-medium" />
    </label>
    <div class="relative ml-1">
      <p class="text-gray-500 text-sm">{{ label ? 'Si' : 'Activo' }}</p>
    </div>
  </div>
</template>