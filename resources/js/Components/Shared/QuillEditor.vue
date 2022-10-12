<script setup>
import { ref, computed } from 'vue';

const customToolbar = ref(['bold', 'italic', 'underline', 'link', { 'list': 'ordered' }, { 'list': 'bullet' }]);
const props = defineProps({
  modelValue: String,
});
const emit = defineEmits(['update:modelValue']);

const proxyValue = computed({
  get() {
    return props.modelValue;
  },

  set(val) {
    emit('update:modelValue', val);
  },
});

</script>
<template>
  <div class="border-gray-50 focus:border-gray-400 hover:border-gray-400 focus:ring hover:ring focus:ring-gray-300 hover:ring-gray-300 focus:ring-opacity-50 hover:ring-opacity-50  shadow-sm disabled:bg-slate-50 rounded-md">
    <quill-editor 
      theme="snow"
      :toolbar="customToolbar" 
      contentType="html"
      v-model:content="proxyValue"
    >
    </quill-editor>
  </div>
</template>