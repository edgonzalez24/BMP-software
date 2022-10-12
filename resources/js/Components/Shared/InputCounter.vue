<script setup>
  import { computed } from 'vue';
  const props = defineProps({
    value: String | Number
  });
  const emit = defineEmits(['update:value']);

  const proxyValue = computed({
    get() {
      return props.value;
    },

    set(val) {
      emit('update:value', val >= 0 ? val : 0 );
    },
  });
</script>
<template>
  <div class="custom-number-input h-10 w-full">
    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
      <button type="button" @click.native="proxyValue = proxyValue - 1"
        class=" bg-dark-blue-500 hover:bg-opacity-90 h-full w-20 rounded-l cursor-pointer outline-none">
        <span class="m-auto text-2xl font-thin text-white">−</span>
      </button>
      <input 
        v-model="proxyValue"
        type="number"
        class="border-transparent outline-none focus:outline-none text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700 "
        name="custom-input-number">
      <button type="button" @click.native="proxyValue = proxyValue + 1"
        class="bg-dark-blue-500 hover:bg-opacity-90 h-full w-20 rounded-r cursor-pointer">
        <span class="m-auto text-2xl font-thin text-white">+</span>
      </button>
    </div>
  </div>
</template>
<style scoped>
  input[type='number']::-webkit-inner-spin-button,
  input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  
  .custom-number-input input:focus {
    outline: none !important;
    border-color: transparent !important;
    box-shadow: none !important;
  }

  .custom-number-input button:focus {
    outline: none !important;
  }
</style>